<?php

namespace App\ViewComposers;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
/*
|--------------------------------------------------------------------------
| 管理者(admin)ViewComposer
|--------------------------------------------------------------------------
*/
class AdminComposer
{
    /**
     * データをビューと結合
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('admin', Auth::user()->admin );
    }
}
