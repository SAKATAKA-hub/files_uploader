<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
/**
 * =========================================
 *  管理者画面　コントローラー
 * =========================================
*/
class AdminController extends Controller
{
    /**
     * ----------------------------------
     *  管理者登録　処理
     * ----------------------------------
    */
        /**
         * 管理者一覧の表示(register_list)
         *
         * @return \Illuminate\View\View
        */
        public function register_list()
        {
            //全顧客情報の取得
            $admin_menbers = \App\Models\Administrator::all();


            return view('admin.register_list', compact( 'admin_menbers' ) );
        }




        /**
         * 管理者登録処理(register_post)
         *
         * @param \App\Http\Requests\RegisterFormRequest $request (バリデーション)
         * @return \Illuminate\View\View
        */
        public function register_post(\App\Http\Requests\RegisterFormRequest $request)
        {
            // ユーザー情報の保存
            $user = new \App\Models\User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'master' => $request->master ? 1 : 0
            ]);
            $user->save();
            $administrator = new \App\Models\Administrator([
                'user_id' => $user->id,
                'name' => $request->name,
                'master' => 0,
                'get_mail' => 1,
            ]);
            $administrator->save();



            # 管理者一覧へリダイレクト
            return redirect()->route('admin.register_list')
            ->with('alert-success','新規管理者を1名登録しました。');
        }





        /**
         * 管理者情報編集ページの表示(register_edit)
         *
         * @param integer //編集管理者ID
         * @return \Illuminate\View\View
        */
        public function register_edit($admin_menber_id)
        {
            $edit_admin =  \App\Models\Administrator::find($admin_menber_id);
            return view( 'admin.register_edit',compact('edit_admin') );
        }




        /**
         * 管理者情報の更新(register_update)
         *
         * @param \App\Http\Requests\RegisterFormRequest $request (バリデーション)
         * @return \Illuminate\View\View
        */
        public function register_update(\App\Http\Requests\RegisterFormRequest $request)
        {


            # 管理者情報更新
            if( isset($request->name) )
            {
                $update_admin = \App\Models\Administrator::find($request->admin_id);
                $update_admin->update([
                    'name' => $request->name,
                ]);


                $update_admin->user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                return redirect()->route('admin.register_edit', $request->admin_id )
                ->with('alert-success','管理者情報を更新しました。');
            }


            # パスワード更新
            if( isset($request->password) )
            {
                $update_user = \App\Models\User::find($request->user_id);
                $update_user->update([
                    'password' => \Illuminate\Support\Facades\Hash::make( $request->password ),
                ]);

                return redirect()->route('admin.register_edit', $update_user->admin->id )
                ->with('alert-success','パスワードを更新しました。');
            }


            # その他設定更新(スイッチによる設定の更新)
            if( isset( $request['form-switch'] ) )
            {
                $update_admin = \App\Models\Administrator::find($request->admin_id);
                $update_admin->update([
                    'get_mail' => isset( $request->get_mail ) ? 1 :0 ,
                    'master' => isset( $request->master ) ? 1 :0,
                ]);

                return redirect()->route('admin.register_edit', $request->admin_id )
                ->with('alert-success','その他設定を更新しました。');
            }



            return redirect()->route('admin.register_edit', $request->admin_id );
        }




        /**
         * 管理者情報の削除(register_destroy)
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\View\View
        */
        public function register_destroy(Request $request)
        {
            # 管理者の削除
            \App\Models\User::find($request->user_id)->delete();


            # リダイレクト
            return redirect()->route('admin.register_list')
            ->with('alert-danger', '管理者情報を1件削除しました。');
        }




    /**
     * ----------------------------------
     *  ログイン履歴
     * ----------------------------------
    */
        /**
         * ログイン履歴の表示(login_record_list)
         *
         * @return \Illuminate\View\View
        */
        public function login_record_list()
        {
            $login_records = \App\Models\LoginRecord::orderBy('id','desc')->get();

            return view( 'admin.login_record_list', compact('login_records') );
        }
    //
}
