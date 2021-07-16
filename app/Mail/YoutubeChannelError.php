<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YoutubeChannelError extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $channelId,$point,$channelTitle;
    public function __construct($channelId,$channelTitle,$point)
    {
        $this->channelId = $channelId;
        $this->point = $point;
        $this->channelTitle = $channelTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.youtubeChannelError')
                    ->subject('Youtube Channel Error')
                    ->with('channelId',$this->channelId)
                    ->with('point',$this->point)
                    ->with('title',$this->channelTitle);
    }
}
