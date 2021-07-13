<?php

namespace App\Http\Livewire\Admin;

use App\Models\YoutubeChannel;
use App\Models\YoutubeLink;
use Exception;
use GuzzleHttp\Client;
use Livewire\Component;

class AddYoutube extends Component
{
    public $links,$channels,$channel,$videoLink,$api='AIzaSyC0qGS7V2zp4cq3p3Gry70xoiXcbYfC4_I';
    public function mount()
    {
    }
    public function saveChannel()
    {
        $this->validate([
            'channel' => 'required|unique:youtube_channels,link',
        ],[
            'channel.unique' => 'This channel is already stored.'
        ]);
        $channelId = $this->channel;
        YoutubeChannel::create([
            'link' => $channelId
        ]);
        $api = 'AIzaSyB9PqbiDlzL0epogyZYOfZ6ownMkVMXVVw';
        $pageToken = "";
        do
        {
            $videoClient = new Client();
            $requestVideo = $videoClient->get('https://www.googleapis.com/youtube/v3/search?key='.$api.'&channelId='.$channelId.'&part=id,snippet&maxResults=50&pageToken='.$pageToken);
            $resultVideo = json_decode($requestVideo->getBody());
            foreach($resultVideo->items as $video)
            {
                if(isset($video->id->videoId))
                {
                    try {
                    YoutubeLink::create([
                        'link'=>$video->id->videoId,
                    ]);
                    }
                    catch(Exception $e) {
                    }
                }
            }
            if(isset($resultVideo->nextPageToken))
                $pageToken = $resultVideo->nextPageToken;
        } while(isset($resultVideo->nextPageToken));
        $this->reset('channel');
        $results = json_decode($requestVideo->getBody())->items;
        $channelName = $results[0]->snippet->channelTitle;
        session()->flash('ChannelSaved', 'Channel <div class="d-inline font-weight-bold text-danger">'.$channelName.'</div> successfully stored.');
    }

    public function saveVideo()
    {
        $this->validate([
            'videoLink' => 'required|unique:youtube_links,link',
        ],[
            'videoLink.unique' => 'This video is already stored.'
        ]);
        YoutubeLink::create([
            'link'=>$this->videoLink,
        ]);
        $this->reset('videoLink');
        session()->flash('VideoSaved', 'Video Added Successfully.');
    }
    public function render()
    {
        $this->links = YoutubeLink::get()->count();
        $this->channels = YoutubeChannel::get()->count();
        return view('livewire.admin.add-youtube');
    }
}
