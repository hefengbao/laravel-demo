<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostCommented extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * 邮件标题
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: '您的文章《'.$this->comment->post->title.'》有新的评论',
        );
    }

    /**
     * 邮件正文
     *
     * view 指定邮件视图
     * with 传递到视图的数据，以数组形式
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mails.post_commented',
            with: [
                'comment' => $this->comment
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
