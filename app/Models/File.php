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
        'dir_company_id','name','path','size','auth_key',
    ];

    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    |
    |
    */
        # DirCompanyモデル リレーション ($file->dir_company)
        public function dir_company(){
            return $this->belongsTo(DirCompany::class);
        }


    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */

        /**
         * ファイルサイズ $file->size_text
         * @return String
        */
        public function getSizeTextAttribute(){

            if($this->size > 1000*1000*1000){
                return round( $this->size/( 1000*1000*1000),2 ).'TB';

            }
            elseif($this->size > 1000*1000){
                return round( $this->size/( 1000*1000),2 ).'MB';

            }
            elseif($this->size > 1000){
                return round( $this->size/( 1000),2 ).'KB';

            }
            else{
                return $this->size.'B';

            }

        }



}
