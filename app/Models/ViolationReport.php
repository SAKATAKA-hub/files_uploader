<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題集の違反通報
 * ===============================
 */
class ViolationReport extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','gest_name','gest_email',
        'question_group_id','body','responded','violation_report_type_id'
    ];
}