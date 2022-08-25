<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $dir_companys = \App\Models\DirCompany::orderBy('id','desc')->get();


        return view('admin.dir_company.list',compact( 'dir_companys' ));
    }

    # 求人企業新規作成フォーム(create)
    # 求人企業新規作成処理(post)
    # 求人企業編集フォーム(edit)
    # 求人企業編集処理(update)
    # 求人企業の削除(destory)
}
