<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/**
 * ===================================================
 *  求人企業のファイル一覧　処理 AdminDirCompanyFileController
 * ===================================================
*/
class AdminDirCompanyFileController extends Controller
{
    /**
     * ファイル一覧(list)
     *
     * @param \App\Models\DirCompany $dir_company //企業情報
     * @param String $auth_key
     * @return \Illuminate\View\View
    */
    public function list( \App\Models\DirCompany $dir_company, $auth_key )
    {
        # ページ認証
        if( $dir_company->auth_key != $auth_key ){ return redirect()->back(); }

        return view('admin.dir_company.file_list',compact( 'dir_company' ));
    }



    /**
     * ファイルの表示(show)
     *
     * @param \App\Models\File $file //企業情報
     * @param String $auth_key
     * @return redirect
    */
    public function show( \App\Models\File $file, $auth_key )
    {
        # ページ認証
        if( $file->auth_key != $auth_key ){ return redirect()->back(); }

        return redirect()->to(  asset('storage/'.$file->path) );
    }



    /**
     * ファイルのダウンロード(download)
     *
     * @param \App\Models\File $file //企業情報
     * @return download
    */
    public function download( \App\Models\File $file, $auth_key )
    {
        # ページ認証
        if( $file->auth_key != $auth_key ){ return redirect()->back(); }

        return Storage::download( $file->path, $file->name );
    }





    /**
     * ファイルのアップロード(upload)
     *
     * @param Illuminate\Http\Request $request
    */
    public function upload( Request $request )
    {

        # ファイルのアップロード
        $input_file_name = 'upload_file';
        $dir = 'upload/file_uploder/'; //アップロード先ディレクトリ名
        $file_path =  $request->file( $input_file_name )->store($dir);


        # データベース保存
        $file = new \App\Models\File([
            'dir_company_id' => $request->dir_company_id,
            'name' => $request->file( $input_file_name )->getClientOriginalName(),
            'size' => $request->file( $input_file_name )->getSize(),
            'path' => $file_path,
            'auth_key' => \Illuminate\Support\Str::random(40),
        ]);
        $file->save();


        # リダイレクト
        $dir_company = \App\Models\DirCompany::find($request->dir_company_id);
        $route_params =  ['dir_company'=>$dir_company,'auth_key'=>$dir_company->auth_key];
        return redirect()->route('admin.dir_company.file.list', $route_params )
        ->with('alert-success','ファイルを一件アップロードしました。');

    }


    /**
     * ファイルの削除(destory)
     *
     * @param Illuminate\Http\Request $request
     * @return download
    */
    public function destory( Request $request )
    {
        # ファイルデータの取得
        $file = \App\Models\File::find( $request->file_id );


        # ファイルデータの取得
        $file = \App\Models\File::find( $request->file_id );

        # ファイルを削除
        $delete_path = $file->path;
        if( Storage::exists( $delete_path ) ){ storage::delete( $delete_path ); }


        # DBデータの削除
        $file->delete();



        # リダイレクト
        $route_params =  ['dir_company'=>$file->dir_company,'auth_key'=>$file->dir_company->auth_key];
        return redirect()->route('admin.dir_company.file.list', $route_params )
        ->with('alert-danger','ファイルを一件削除しました。');
    }

}
