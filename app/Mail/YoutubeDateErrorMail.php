<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YoutubeDateErrorMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $videoId,$diff,$videoTitle;
    public function __construct($videoId,$videoTitle,$diff)
    {
        $this->videoId = $videoId;
        $this->diff = $diff;
        $this->videoTitle = $videoTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.YoutubeDateErrorMail')
                    ->subject('Youtube Error')
                    ->with('videoId',$this->videoId)
                    ->with('diff',$this->diff)
                    ->with('title',$this->videoTitle);
    }
}
