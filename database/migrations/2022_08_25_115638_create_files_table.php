<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * ===============================
 *  求人企業のファイル
 * ===============================
 */

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();

            // dir_companieテーブルとの紐づけ
            $table->unsignedBigInteger('dir_company_id')->comment('求人企業フォルダID');
            $table->foreign('dir_company_id')
            ->references('id')->on('dir_companies') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            $table->string('name',    150)->comment('ファイル名');
            $table->string('path',    150)->comment('ファイルパス');
            $table->string('auth_key',150)->comment('認証キー');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
