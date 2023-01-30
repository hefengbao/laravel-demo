<?php

namespace App\Listeners;

use App\Events\PostCommented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostCommentedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostCommented  $event
     * @return void
     */
    public function handle(PostCommented $event)
    {
        $comment = $event->comment;

        // TODO 发送邮件通知

    }
}
