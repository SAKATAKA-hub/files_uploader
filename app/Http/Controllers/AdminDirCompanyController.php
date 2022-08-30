<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
/**
 * ===================================================
 *  求人企業一覧　処理 AdminDirCompanyController
 * ===================================================
*/
class AdminDirCompanyController extends Controller
{
    /**
     * 求人企業一覧(list)
     * @return \Illuminate\View\View
    */
    public function list()
    {
        #求人企業一覧の取得
        $dir_companys = \App\Models\DirCompany::all();


        return view('admin.dir_company.list',compact( 'dir_companys' ));
    }

    # 求人企業新規作成フォーム(create)




    /**
     * 求人企業新規作成処理(post)
     *
     * @param Illuminate\Http\Request $request
    */
    public function post( Request $request )
    {
        # データベース保存
        $dir_company = new \App\Models\DirCompany([
            'name' => $request->name,
            'auth_key' => \Illuminate\Support\Str::random(40),
        ]);
        $dir_company->save();


        return redirect()->route('admin.dir_company.list' )
        ->with('alert-success','フォルダを一件作成しました。');

    }




    /**
     * 求人企業編集処理(update)
     *
     * @param Illuminate\Http\Request $request
    */
    public function update( Request $request )
    {
        # フォルダ情報の取得
        $dir_company = \App\Models\DirCompany::find( $request->dir_company_id );

        # データベース保存
        $dir_company->update([
            'name' => $request->name,
        ]);


        return redirect()->route('admin.dir_company.list' )
        ->with('alert-info','フォルダを一件更新しました。');

    }




    /**
     * 求人企業の削除(destory)
     *
     * @param Illuminate\Http\Request $request
    */
    public function destory( Request $request )
    {
        # フォルダ情報の取得
        $dir_company = \App\Models\DirCompany::find( $request->dir_company_id );


        # ファイルを削除
        foreach ( $dir_company->files as $files ) {
            $delete_path = $files->path; //アップロード先ディレクトリ名
            if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }
        }


        # データベース保存
        $dir_company->delete();


        return redirect()->route('admin.dir_company.list' )
        ->with('alert-danger','フォルダを一件削除しました。');

    }

}
