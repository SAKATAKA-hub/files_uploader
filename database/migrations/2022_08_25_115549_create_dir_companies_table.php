<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * ===============================
 *  求人企業フォルダ
 * ===============================
 */

class CreateDirCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dir_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',    150)->comment('企業名');
            $table->string('manager', 150)->comment('担当者名')->nullable()->default(null);
            $table->string('comment', 150)->comment('コメント')->nullable()->default(null);
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
        Schema::dropIfExists('dir_companies');
    }
}
