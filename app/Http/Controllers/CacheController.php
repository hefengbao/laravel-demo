<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CacheController extends Controller
{
    public function index()
    {
        /*
         * 参数 key: 缓存标识
         * 参数 value: 缓存值，
         * 参数 ttl: 缓存时间，单位为秒，默认为null,表示无限期存储
         */
        Cache::put('active_user_count', 10, 24 * 60 * 60);

        /*
         * 和 Cache::put() 等同
         */
        \cache('active_user_count', 10, 24 * 60 * 60);

        /*
         *参数 key: 缓存标识
         * 参数 default: 指定默认值
         */
        Cache::get('active_user_count', 0);

        \cache('active_user_count', 0);

        /**
         * 如果 active_user_count 缓存不存在，则返回闭包中的结果
         */
        Cache::get('active_user_count', function (){
            return \Illuminate\Support\Facades\DB::select('select count(*) from uses where active = 1');
        });
    }

    public function redis()
    {
        /*
         * 用户 1 今日签到
         */
        Redis::sAdd('sign:2023:user:1', date('Y-m-d'));

        /*
         * 用户 1 今日是否已签到签到
         */
        Redis::sIsMemeber('sign:2023:user:1', date('Y-m-d'));

        /*
         * 用户 1 2023 年签到天数
         */
        Redis::sCard('sign:2023:user:1');
    }
}
