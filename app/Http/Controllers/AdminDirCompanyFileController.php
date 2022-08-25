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
     * @return \Illuminate\View\View
    */
    public function list( \App\Models\DirCompany $dir_company )
    {

        return view('admin.dir_company.file_list',compact( 'dir_company' ));
    }



    /**
     * ファイルの表示(show)
     *
     * @param \App\Models\File $file //企業情報
     * @return redirect
    */
    public function show( \App\Models\File $file )
    {
        return redirect()->to(  asset('storage/'.$file->path) );
    }



    /**
     * ファイルのダウンロード(download)
     *
     * @param \App\Models\File $file //企業情報
     * @return download
    */
    public function download( \App\Models\File $file )
    {
        return Storage::download( $file->path, $file->name );
    }
    # ファイルのアップロードフォーム(upload)
    # ファイルのアップロード処理(post)
    # ファイルの削除(destory)
}
