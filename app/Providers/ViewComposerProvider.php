<?php

namespace App\Providers;
use App\ViewComposers\AdminComposer;
use App\ViewComposers\WorkerConmoser;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.*', AdminComposer::class);   //管理者ページ用ViewComposer
    }
}
