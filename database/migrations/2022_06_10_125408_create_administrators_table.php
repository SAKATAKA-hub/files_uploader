<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
| =============================================
|  管理者 (Administrators) テーブル
| =============================================
*/

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->comment('名前');
            $table->boolean('master')->default(0)->comment('管理者編集権限');
            $table->boolean('get_mail')->default(1)->comment('メール受信設定');
            $table->timestamps();

            // userテーブルとの紐づけ
            $table->unsignedBigInteger('user_id')->comment('リレーションID');
            $table->foreign('user_id')
            ->references('id')->on('users') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
