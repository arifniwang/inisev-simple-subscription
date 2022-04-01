<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostsEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Posts')
            ->view('mail.posts', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
}
