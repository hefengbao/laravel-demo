<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // url()、route()、 asset() 等生成的 url 使用 https
        //URL::forceScheme('https');

        // 分页使用 bootstrap 样式
        //Paginator::useBootstrap();

        // 分页使用 bootstrap 5 样式
        //Paginator::useBootstrapFive();

        // 非正式环境不适用懒加载
        //Model::preventLazyLoading( ! app()->isProduction() );

        // 给模型设置别名
        /*Relation::enforceMorphMap([
            'user' => \App\Models\User::class
        ]);*/

        // 取消所有模型的 mass assignable 保护，即不再验证模型中 $fillable 和 &guard
        //Model::unguard();
    }
}
