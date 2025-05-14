<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // 主キー（自動増分のbigint）

            $table->foreignId('user_id') // 投稿者のID
                  ->constrained()       // usersテーブルのidと連携
                  ->onDelete('cascade'); // 親のuserが削除されたらこの投稿も削除

            $table->foreignId('exercise_id') // どのトレーニング種目に対する投稿か
                  ->constrained()           // exercisesテーブルと外部キー制約
                  ->onDelete('cascade');

            $table->string('title'); // 投稿タイトル
            $table->text('description')->nullable(); // 投稿本文（メモ）。null可

            $table->timestamps();    // created_at / updated_at 自動追加
            $table->softDeletes();   // deleted_at カラム追加（論理削除に対応）
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts'); // テーブル削除（ロールバック用）
    }
};