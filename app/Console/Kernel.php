<?php

namespace App\Console;

use App\Models\YoutubeLink;
use App\Notifications\YoutubeNotification;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redis;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $points = [
                99000 => '99K',
                100000 => '100K',
                199000 => '199K',
                200000 => '200K',
                299000 => '299K',
                300000 => '300K',
                499000 => '499K',
                500000 => '500K',
                999000 => '999K',
                1000000 => '1M',
                1999000 => '1M 999K',
                2000000 => '2M',
                2999000 => '2M 999K',
                3000000 => '3M',
                4999000 => '4M 999K',
                5000000 => '5M',
                9999000 => '9M 999K',
                10000000 => '10M',
                19999000 => '19M 999K',
                20000000 => '20M',
                29999000 => '29M 999K',
                30000000 => '30M',
                49999000 => '49M 999K',
                50000000 => '50M',
                99999000 => '99M 999K',
                100000000 => '100M',
                199999000 => '199M 999K',
                200000000 => '200M',
            ];
            $api = 'AIzaSyASI7DID43nrOlejpE66ljAgZzNjFIFZYE';
            $videos = YoutubeLink::pluck('link')->chunk(50);
            foreach($videos as $videoArray) {
                $videoLink = "https://www.googleapis.com/youtube/v3/videos?part=statistics,snippet,id&key=".$api."&id=".$videoArray->join(',');
                $videoClient = new Client();
                $requestVideo = $videoClient->get($videoLink);
                $resultVideo = json_decode($requestVideo->getBody());
                $videoCollection = $resultVideo->items;
                foreach($videoCollection as $videoInfo)
                {
                    $stat = collect();
                    $videoId = $videoInfo->id;
                    $view = $videoInfo->statistics->viewCount;
                    $releaseDate = Carbon::parse($videoInfo->snippet->publishedAt);
                    $oldview = Redis::exists('videoStat:'.$videoId) ? json_decode(Redis::get('videoStat:'.$videoId))->views : NULL;
                    if($oldview != NULL) {
                        $stat->put('views',$view);
                        $stat->put('oldView',$oldview);
                    }
                    else
                        $stat->put('views',$view);
                    $stat->put('id',$videoId);
                    $stat->put('date',$releaseDate);
                    Redis::del('videoStat:'.$videoId);
                    Redis::set('videoStat:'.$videoId,json_encode($stat));
                    if($oldview != NULL) {
                        try{
                            if($oldview != $view) {
                                foreach($points as $index => $point) {
                                    if($oldview < $index && $view >= $index) {
                                        Notification::send('-1001421932477',new YoutubeNotification("https://youtu.be/".$videoId." has crossed ".$point." views."));
                                    }
                                }
                            }
                            if($releaseDate->isBirthday() && !Redis::exists('releaseNotifier:'.$videoId)) {
                                Redis::set('releaseNotifier:'.$videoId,TRUE);
                                if(!$releaseDate->isToday())
                                    Notification::send('-1001421932477',new YoutubeNotification("https://youtu.be/".$videoId." was released on this day ".$releaseDate->diffInYears()." year(s) ago."));
                            }
                            else if(!$releaseDate->isBirthday() && Redis::exists('releaseNotifier:'.$videoId)) {
                                Redis::del('releaseNotifier:'.$videoId);
                            }
                        }
                        catch(Exception $e) {
                        }
                    }
                }
            }
        })->everyFifteenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
