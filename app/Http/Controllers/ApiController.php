<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    public function channel($channelId)
    {
        $channel = json_decode(Cache::get('channelStat-'.$channelId));
        $channelInfo = collect();
        $channelInfo->put('id',$channel->id);
        $channelInfo->put('subscribers',$channel->subscribers);
        if(isset($channel->oldSubs))
        $channelInfo->put('oldSubs',$channel->oldSubs);
        $channelInfo->put('thumbnail',$channel->thumbnail);
        return $channelInfo;
    }
    public function video($videoId)
    {
        $video = json_decode(Cache::get('videoStat-'.$videoId));
        $videoInfo = collect();
        $videoInfo->put('id',$video->id);
        $videoInfo->put('views',$video->views);
        if(isset($video->oldView))
        $videoInfo->put('oldView',$video->oldView);
        $videoInfo->put('thumbnail',$video->thumbnail);
        $videoInfo->put('date',$video->date);
        return $videoInfo;
    }
}
