<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| 管理者(Administartor) - 認証
|--------------------------------------------------------------------------
*/
class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ログイン・ログアウト処理
    |--------------------------------------------------------------------------
    */

        /**
         * ログイン処理(login)
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\View\View
        */
        public function login(Request $request)
        {
            # [ アカウントとパスワードの照合チェック ] -------

                # エラーカウントのチェック
                $max_count = 3; //エラーの最大値
                $frozen_min = 15; //アクセス停止時間
                if(
                    $user = \App\Models\User::where('email',$request->email)->first()
                ){

                    //. $frozen_min分後であれば、カウントリセット
                    $date_ob01 = \Carbon\Carbon::parse($user->updated_at); //最終ログイン入力時間
                    $date_ob02 = \Carbon\Carbon::parse('now');
                    $diff_min = $date_ob01->diffInMinutes($date_ob02); //現在時刻との時間差異
                    if( $diff_min > $frozen_min ){ $user->update(['error_count' => 0]); } //カウントリセット


                    //. エラーカウントの最大値を超える時、ログインフォームへリダイレクト
                    if( $user->error_count >= $max_count ){
                        return back()->with('login_error','アカウントにロックがかかりました。約15分後にロックが解除されます。');
                    }
                }




                # ログイン成功処理（求職者のアカウントが照合された時）
                Auth::attempt( $request->only('email','password'), $request->remember );
                if( Auth::check() && Auth::user()->admin )
                {
                    # ユーザー情報をセッションに保存
                    $request->session()->regenerate();

                    # ログイン履歴の保存
                    $login_record = new \App\Models\LoginRecord(['user_id' => Auth::user()->id,]);
                    $login_record->save();

                    # ログインエラーカウントのリセット
                    $user->update(['error_count' => 0]);

                    # ログイン前に訪れたページがある場合、前のページに戻る
                    if(session('before_admin_url'))
                    {
                        return redirect( session('before_admin_url') );
                    }


                    // マイページTOPへリダイレクト
                    return redirect()->route('admin.home');

                }


            # [ ログイン失敗の処理 ] -------

                // エラーカウントの加算
                if( isset($user) ){$user->update(['error_count' => $user->error_count + 1]);}

                // エラーメッセージの作成
                $message = '';
                if( Auth::check() ){
                    $message = 'このメールアドレスは利用できません。';//管理者アカウント
                }
                if( \App\Models\User::where('email',$request->email)->first() ){
                    $message = 'パスワードが間違っています。3回入力に失敗すると、しばらくログインできなくなります。';
                }
                else{
                    $message = 'このメールアドレスは登録されていません。';
                }

                // ログインフォームへ戻る
                return back()->with('login_error',$message);

            //
        }


        /**
         * ログアウト処理(logout)
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\View\View
        */
        public function logout(Request $request)
        {

            Auth::logout(); //ユーザーセッションの削除

            $request->session()->invalidate(); //全セッションの削除

            $request->session()->regenerateToken(); //セッションの再作成(二重送信の防止)

            # ログインページへリダイレクト
            return redirect()->route('admin_auth.login_form');
        }





    //
}
