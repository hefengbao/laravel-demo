<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PostCommented implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        /**
         * 在 Queueable trait 中定义的
         * 这里可以覆盖全局设定， 即 .env 中的 QUEUE_CONNECTION 设置
         * @var string
         */
        $this->connection = 'redis';

        /**
         * 在 Queueable trait 中定义的
         * 指定使用 emails 队列, 可选项， 默认使用 default
         * @var string
         */
        $this->queue = 'emails';

        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 发送通知邮件
        Log::info('这里要发送通知邮件');
    }
}
