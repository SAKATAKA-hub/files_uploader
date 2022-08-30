<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;

# Home
Route::get('/', function(){

    return redirect()->route( 'admin.dir_company.list' ); //求人企業一覧

    // return view('home');
})->name('home');

/**
 * ----------------------------------
 *  求人企業のファイル一覧　処理 CompanyFileController
 * ----------------------------------
*/

    # ファイル一覧(list)
    Route::get('/dir_company/file/list/{dir_company}/{auth_key}', [Controllers\CompanyFileController::class, 'list'])
    ->name('dir_company.file.list');

    # ファイルの表示(show)
    Route::get('/dir_company/file/show/{file}/{auth_key}', [Controllers\CompanyFileController::class, 'show'])
    ->name('dir_company.file.show');

/*
|--------------------------------------------------------------------------
| 認証・登録・パスワード変更　(UserAuthController)
|--------------------------------------------------------------------------
*/
    /* ユーザー認証 */

        # ログイン画面の表示(login_form)
        Route::get('/user_auth/login_form', function () { return view('user_auth.login_form'); })
        ->name('user_auth.login_form');

        # ログイン処理(login)
        Route::post('/user_auth/login', [Controllers\UserAuthController::class, 'login'])
        ->name('user_auth.login');

        # ログアウト処理(logout)
        Route::get('/user_auth/logout', [Controllers\UserAuthController::class, 'logout'])
        ->name('user_auth.logout');

        # ログインが必要ですページ(require_login)　※ログイン前にログインが必要なページにアクセスした際に表示されるページ
        Route::get('/user_auth/require_login', function () { return view('user_auth.require_login'); })
        ->name('user_auth.require_login');


    /* ユーザー登録 */

        # ユーザー登録画面の表示(register_form)
        Route::get('/user_auth/register_form', function(){ return view('user_auth.register_form' ); })
        ->name('user_auth.register_form');

        # ユーザー登録API(register_api)
        Route::post('/user_auth/register_api', [Controllers\UserAuthController::class, 'register_api'])
        ->name('user_auth.register_api');

        # 登録済メールアドレスか確認するAPI(email_unique_api)
        Route::post('/user_auth/email_unique_api', [Controllers\UserAuthController::class, 'email_unique_api'])
        ->name('user_auth.email_unique_api');


    /* パスワードリセット */

        # パスワードリセット画面の表示(reset_pass_form)
        Route::get('/user_auth/reset_pass_form', function () { return view('user_auth.reset_pass_form'); })
        ->name('user_auth.reset_pass_form');

        # パスワードリセット ステップ01(reset_pass_step01_api)
        Route::patch('/user_auth/reset_pass_step01_api', [Controllers\UserAuthController::class, 'reset_pass_step01_api'])
        ->name('user_auth.reset_pass_step01_api');

        # パスワードリセット ステップ02(reset_pass_step02_api)
        Route::patch('/user_auth/reset_pass_step02_api', [Controllers\UserAuthController::class, 'reset_pass_step02_api'])
        ->name('user_auth.reset_pass_step02_api');

    //

    # 退会処理(destroy)
    Route::delete('/user_auth/destroy', [Controllers\UserAuthController::class, 'destroy'])
    ->name('user_auth.destroy');


/*
|--------------------------------------------------------------------------
| マイページ　処理　MyPageController
|--------------------------------------------------------------------------
*/
    Route::middleware(['user_auth'])->group(function () {

        # マイページ[問題一覧](mypage) //->name('make_question_group.list');
        Route::get('/mypage',function(){ return redirect()->route('make_question_group.list'); })
        ->name('mypage');

        # 問題集を作る //->name('make_question_group.create');

        # いいねした問題集(like_list)
        Route::get('/mypage/like_list',[Controllers\MyPageController::class, 'like_list'])
        ->name('like_list');

        # 受検成績 //->name('results.list');

        # 通知(infomation_list)
        Route::get('/mypage/infomation_list',[Controllers\MyPageController::class, 'infomation_list'])
        ->name('infomation_list');

        # プロフィール・設定変更(settings) //->name('settings');

        # ログアウト//->name('user_auth.logout');

    });//end middleware
/*
|--------------------------------------------------------------------------
| 各種設定　処理　SettingsController
|--------------------------------------------------------------------------
*/
    Route::middleware(['user_auth'])->group(function () {

        # プロフィール・設定変更 表示(settings)
        Route::get('/mypage/settings', [Controllers\SettingsController::class, 'settings'])
        ->name('settings');


        # プロフィールの変更(update_user_profile)
        Route::post('/mypage/settings/update_user_profile', [Controllers\SettingsController::class,'update_user_profile'])
        ->name('update_user_profile');


        # メールアドレスの変更(update_user_email)
        Route::post('/mypage/settings/update_user_email', [Controllers\SettingsController::class,'update_user_email'])
        ->name('update_user_email');


        # 退会前アンケートフォーム(withdrawal_form)
        Route::get('/mypage/withdrawal_form', function(){ return view('user_auth.withdrawal_form'); })
        ->name('withdrawal_form');


    });//end middleware
/*
|--------------------------------------------------------------------------
| その他のサービス　ServiceController
|--------------------------------------------------------------------------
*/
    # お問い合わせ

        # お問い合わせ[投稿](contact/post/api)
        Route::post('/contact/post/api', [Controllers\ServiceController::class, 'contact_post_api'])
        ->name('contact.post.api');

        # お問い合わせ[一覧](contact/list/api)
        # お問い合わせ[削除](contact/destroy/api)

    //

/*
|--------------------------------------------------------------------------
| フッターメニュー (footer_menu)
|--------------------------------------------------------------------------
*/
    # 利用規約(trems)
    Route::get('/trems', function () { view('footer_menu.trems'); })
    ->name('footer_menu.trems');

    # プライバシーポリシー(privacy_policy)
    Route::get('/privacy_policy', function () { view('footer_menu.privacy_policy'); })
    ->name('footer_menu.privacy_policy');

    # お問い合わせ(contact)
    Route::get('/contact', function () { view('footer_menu.contact'); })
    ->name('footer_menu.contact');


    # よくある質問(q_and_a)
    Route::get('/q_and_a', function () { view('footer_menu.q_and_a'); })
    ->name('footer_menu.q_and_a');



//

/*
|--------------------------------------------------------------------------
| 管理者(Administartor) - 認証
|--------------------------------------------------------------------------
*/

    # ログイン画面の表示(admin_auth.login_form)
    Route::get('/admin_auth/login_form', function () { return view('admin_auth.login_form'); })
    ->name('admin_auth.login_form');

        # ログイン処理(admin_auth.login)
        Route::post('/admin_auth/login', [Controllers\AdminAuthController ::class, 'login'])
        ->name('admin_auth.login');

        # ログアウト処理(admin_auth.logout)
        Route::post('/admin_auth/logout', [Controllers\AdminAuthController ::class, 'logout'])
        ->name('admin_auth.logout');
    //

//


/*
|--------------------------------------------------------------------------
| 管理者ページ
|--------------------------------------------------------------------------
*/
    Route::middleware(['admin_auth'])->group(function () {

        # ホーム(home)
        Route::get('/admin', function () {

            return redirect()->route( 'admin.dir_company.list' ); //求人企業一覧
            // return view('admin.home');
        })->name('admin.home');

        /**
         * ----------------------------------
         *  求人企業一覧　処理 AdminDirCompanyController
         * ----------------------------------
        */
            # 求人企業一覧(list)
            Route::get('/admin/dir_company/list', [Controllers\AdminDirCompanyController::class, 'list'])
            ->name('admin.dir_company.list');

            # 求人企業新規作成処理(post)
            Route::post('/admin/dir_company/post', [Controllers\AdminDirCompanyController::class, 'post'])
            ->name('admin.dir_company.post');

            # 求人企業編集処理(update)
            Route::patch('/admin/dir_company/update', [Controllers\AdminDirCompanyController::class, 'update'])
            ->name('admin.dir_company.update');

            # 求人企業の削除(destory)
            Route::delete('/admin/dir_company/destory', [Controllers\AdminDirCompanyController::class, 'destory'])
            ->name('admin.dir_company.destory');


        /**
         * ----------------------------------
         *  求人企業のファイル一覧　処理 AdminDirCompanyFileController
         * ----------------------------------
        */

            # ファイル一覧(list)
            Route::get('/admin/dir_company/file/list/{dir_company}/{auth_key}', [Controllers\AdminDirCompanyFileController::class, 'list'])
            ->name('admin.dir_company.file.list');

            # ファイルの表示(show)
            Route::get('/admin/dir_company/file/show/{file}/{auth_key}', [Controllers\AdminDirCompanyFileController::class, 'show'])
            ->name('admin.dir_company.file.show');


            # ファイルのダウンロード(download)
            Route::get('/admin/dir_company/file/download/{file}/{auth_key}', [Controllers\AdminDirCompanyFileController::class, 'download'])
            ->name('admin.dir_company.file.download');




            # ファイルのアップロード処理(upload)
            Route::post('/admin/dir_company/file/upload', [Controllers\AdminDirCompanyFileController::class, 'upload'])
            ->name('admin.dir_company.file.upload');

            # ファイルの削除(destory)
            Route::delete('/admin/dir_company/file/destory', [Controllers\AdminDirCompanyFileController::class, 'destory'])
            ->name('admin.dir_company.file.destory');


        /**
         * ----------------------------------
         *  管理者登録　処理
         * ----------------------------------
        */
            # 管理者一覧の表示(register_list)
            Route::get('admin/register_list',[App\Http\Controllers\AdminController::class,'register_list'])
            ->name('admin.register_list');

            # 管理者登録画面の表示(register_input)
            Route::get('admin/register_input',function(){ return view('admin.register_input'); })
            ->name('admin.register_input');

            # 管理者登録処理(register_post)
            Route::post('admin/register_post',[App\Http\Controllers\AdminController::class,'register_post'])
            ->name('admin.register_post');



        /**
         * ----------------------------------
         *  管理者編集・削除　処理
         * ----------------------------------
        */
            # 管理者情報編集ページの表示(register_edit)
            Route::get('admin/register_edit/{admin_menber_id}',[App\Http\Controllers\AdminController::class,'register_edit'])
            ->name('admin.register_edit');

            # 管理者情報の更新(register_update)
            Route::patch('admin/register_update',[App\Http\Controllers\AdminController::class,'register_update'])
            ->name('admin.register_update');

            # 管理者情報の削除(register_destroy)
            Route::delete('admin/register_destroy',[App\Http\Controllers\AdminController::class,'register_destroy'])
            ->name('admin.register_destroy');
        //
        /**
         * ----------------------------------
         *  ログイン履歴
         * ----------------------------------
        */
            # ログイン履歴の表示(login_record_list)
            Route::get('admin/login_record_list',[App\Http\Controllers\AdminController::class,'login_record_list'])
            ->name('admin.login_record_list');

    });//end middleware
//


# ファイル表示テスト
Route::get('/test', function(){


    return redirect()->to(
        asset('storage/site/file/sampl.pdf')
    );
})->name('test.file.show');


# ファイルダウンロードテスト
Route::get('/test/file/download', function(){
    $fileName = 'hogehoge';
    return Storage::download($filePath='site/file/sampl.pdf', $fileName);
})->name('test.file.download');
