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
        Schema::create('likes', function (Blueprint $table) {
            $table->id(); // 主キー（自動増分）

            $table->foreignId('post_id') // いいね対象の投稿ID
                  ->constrained()        // postsテーブルのidと外部キー制約
                  ->onDelete('cascade'); // 投稿が削除されたらこのいいねも削除

            $table->foreignId('user_id') // いいねしたユーザーID
                  ->constrained()        // usersテーブルのidと外部キー制約
                  ->onDelete('cascade'); // ユーザーが削除されたらこのいいねも削除

            $table->timestamps(); // created_at / updated_at の自動追加

            $table->unique(['post_id', 'user_id']); // 重複いいねを防ぐ(1投稿1回までしか押せない)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes'); // テーブルをロールバック（削除）
    }
};
