<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationDD extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $data;
    public $subject;
    public $post_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$data,$subject,$post_id=0)
    {
        $this->subject = $subject;
        $this->user = $user;
        $this->data = $data;
        if($post_id > 0){
            $this->post_id = $post_id;
        }else{
            $this->post_id = 0;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->post_id > 0){
            return $this->view('email.disabled')->with('logo',asset('storage/web/images/logo.png'));
        }else{
            return $this->view('email.deleted')->with('logo',asset('storage/web/images/logo.png'));
        }
    }
}
