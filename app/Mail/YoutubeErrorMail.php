<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YoutubeErrorMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $videoId,$point,$videoTitle;
    public function __construct($videoId,$videoTitle,$point)
    {
        $this->videoId = $videoId;
        $this->point = $point;
        $this->videoTitle = $videoTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.YoutubeErrorMail')
                    ->subject('Youtube Error')
                    ->with('videoId',$this->videoId)
                    ->with('point',$this->point)
                    ->with('title',$this->videoTitle);
    }
}
