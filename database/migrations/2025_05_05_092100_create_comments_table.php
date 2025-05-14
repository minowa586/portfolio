<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // 主キー（自動増分）

            $table->foreignId('post_id') // コメント対象の投稿
                  ->constrained()        // posts テーブルの id と外部キーで紐付け
                  ->onDelete('cascade'); // 投稿が削除されたらコメントも削除

            $table->foreignId('user_id') // コメントを書いたユーザー
                  ->constrained()        // users テーブルの id と外部キーで紐付け
                  ->onDelete('cascade'); // ユーザー削除時にコメントも削除

            $table->text('body'); // コメント本文

            $table->timestamps();    // created_at / updated_at 自動生成
            $table->softDeletes();   // deleted_at を追加（論理削除用）
        });
 }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments'); // マイグレーションのロールバック用
    }
};

