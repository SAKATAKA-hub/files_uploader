<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  求人企業のファイル
 * ===============================
 */
class File extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'dir_company_id','name','path','auth_key',
    ];

    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */

    // /**
    //  * メールアドレス $file->url
    //  * @return String
    // */
    // public function getUrlAttribute(){
    //     return asset('storage/'.$this->path);
    // }


}
