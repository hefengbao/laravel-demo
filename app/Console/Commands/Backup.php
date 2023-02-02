<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Backup extends Command
{
    /**
     * 命名,格式为 command:name
     *
     * @var string
     */
    protected $signature = 'backup:run';

    /**
     * 描述
     *
     * @var string
     */
    protected $description = '项目备份';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // TODO 备份数据库、备份上传的附件等
        Log::info('测试 backup:run');
        return Command::SUCCESS;
    }
}
