<?php

namespace App\Console\Commands;

use App\Mail\CronStarted;
use App\Mail\YoutubeChannelError;
use Illuminate\Console\Command;
use App\Mail\YoutubeDateErrorMail;
use App\Mail\YoutubeErrorMail;
use App\Models\YoutubeChannel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Models\YoutubeLink;
use App\Notifications\YoutubeNotification;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;

class YoutubeCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Doing youtube check';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to('cronjobreport@stringsnbeats.net')->send(new CronStarted());
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
        $api = 'AIzaSyCzPpA1160huBOEubGV-oF-2Eatk-vzwrE';
        $this->line('Using Api: '.$api);
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
                // $this->line('Checking for '.$videoId);
                $view = $videoInfo->statistics->viewCount;
                $releaseDate = Carbon::parse($videoInfo->snippet->publishedAt);
                $oldview = Cache::has('videoStat-'.$videoId) ? json_decode(Cache::get('videoStat-'.$videoId))->views : NULL;
                if($oldview != NULL) {
                    $stat->put('views',$view);
                    $stat->put('oldView',$oldview);
                }
                else
                    $stat->put('views',$view);
                $stat->put('thumbnail',$videoInfo->snippet->thumbnails->high->url);
                $stat->put('id',$videoId);
                $stat->put('date',$releaseDate);
                Cache::forget('videoStat-'.$videoId);
                Cache::rememberForever('videoStat-'.$videoId,function() use($stat) { return json_encode($stat); });
                if($oldview != NULL) {
                    if($oldview != $view) {
                        foreach($points as $index => $point) {
                            if($oldview < $index && $view >= $index) {
                                try {
                                    Notification::send('-1001421932477',new YoutubeNotification("https://youtu.be/".$videoId." has crossed ".$point." views."));
                                    }
                                catch(Exception $e) {
                                    $this->error('Error with '.$videoId);
                                    Mail::to('youtubeerror@stringsnbeats.net')
                                        ->send(new YoutubeErrorMail($videoId,$videoInfo->snippet->title,$point));
                                }
                            }
                        }
                    }
                    if($releaseDate->isBirthday() && !Cache::has('releasedNotifier-'.$videoId)) {
                        Cache::rememberForever('releasedNotifier-'.$videoId,function() { return TRUE; });
                        if(!$releaseDate->isToday())
                        {
                            $diff = $releaseDate->diffInYears() +1;
                            try {
                                Notification::send('-1001421932477',new YoutubeNotification("https://youtu.be/".$videoId." was released on this day ".$diff." year(s) ago."));
                            }
                            catch(Exception $e) {
                                $this->error('Error with '.$videoId);
                                Mail::to('youtubeerror@stringsnbeats.net')
                                    ->send(new YoutubeDateErrorMail($videoId,$videoInfo->snippet->title,$diff));
                            }
                            
                        }
                    }
                    else if(!$releaseDate->isBirthday() && Cache::has('releaseNotifier-'.$videoId)) {
                        Cache::forget('releaseNotifier-'.$videoId);
                    }
                }
                $this->newLine();
            }
        }
        $channels = YoutubeChannel::pluck('link')->chunk(50);
        foreach($channels as $channelArray)
        {
            $channelLink = "https://www.googleapis.com/youtube/v3/channels?part=statistics,snippet,status&maxResults=50&key=".$api."&id=".$channelArray->join(',');
            $channelClient = new Client();
            $requestChannel = $channelClient->get($channelLink);
            $resultChannel = json_decode($requestChannel->getBody());
            $channelCollection = $resultChannel->items;
            foreach($channelCollection as $channelInfo)
            {
                $stat = collect();
                $channelId = $channelInfo->id;
                // $this->line('Checking for '.$channelId);
                if(isset($channelInfo->statistics->subscriberCount)) {
                    $subscribers = $channelInfo->statistics->subscriberCount;
                    $oldSubs = Cache::has('channelStat-'.$channelId) ? json_decode(Cache::get('channelStat-'.$channelId))->subscribers : NULL;
                    if($oldSubs != NULL) {
                        $stat->put('subscribers',$subscribers);
                        $stat->put('oldSubs',$oldSubs);
                    }
                    else
                        $stat->put('subscribers',$subscribers);
                    $stat->put('thumbnail',$channelInfo->snippet->thumbnails->high->url);
                    $stat->put('id',$channelId);
                    Cache::forget('channelStat-'.$channelId);
                    Cache::rememberForever('channelStat-'.$channelId,function() use($stat) { return json_encode($stat); });
                    if($oldSubs != NULL) {
                        if($oldSubs != $subscribers) {
                            foreach($points as $index => $point) {
                                if($oldSubs < $index && $subscribers >= $index) {
                                    try {
                                        Notification::send('-1001421932477',new YoutubeNotification("https://youtu.be/channel/".$channelId." has crossed ".$point." subscribers."));
                                        }
                                    catch(Exception $e) {
                                        $this->error('Error with channel '.$channelId);
                                        Mail::to('youtubeerror@stringsnbeats.net')
                                            ->send(new YoutubeChannelError($channelId,$channelInfo->snippet->title,$point));
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->newLine();
        $this->info('Completed!');
    }
}
