<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * ===================================================
 *  求人企業のファイル一覧　処理 DirCompanyFileController
 * ===================================================
*/
class CompanyFileController extends Controller
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


        // return view('layouts.base');
        return view('file_uploader.file_list',compact( 'dir_company' ));
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
}
