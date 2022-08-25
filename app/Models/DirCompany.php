<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  求人企業フォルダ
 * ===============================
 */

class DirCompany extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name','manager','comment','auth_key',
    ];

    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    |
    |
    */
        # Fileモデル リレーション ($admin->files)
        public function files(){
            return $this->hasMany(File::class,'dir_company_id');
        }
    //
}
