<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
| =============================================
|  管理者 (Administrators) モデル
| =============================================
*/

class Administrator extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name','master','get_mail','user_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    |
    |
    */
        # Userモデル リレーション ($admin->user)
        public function user(){
            return $this->belongsTo(User::class);
        }

    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * メールアドレス $worker->email
     * @return String
    */
    public function getEmailAttribute()
    {
        return \App\Models\User::find($this->user_id)->email;
    }

}
