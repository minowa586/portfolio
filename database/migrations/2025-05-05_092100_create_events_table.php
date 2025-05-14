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
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // 主キー

            $table->foreignId('user_id') // 所有ユーザー
                  ->constrained()        // usersテーブルと外部キーで紐付け
                  ->onDelete('cascade'); // ユーザー削除時に連動削除

            $table->foreignId('stamp_id') // 表示するスタンプ
                  ->nullable()           // null可にすることで上と両立
                  ->constrained()         // stampsテーブルと外部キーで紐付け
                  ->onDelete('set null');  // スタンプが削除されてもイベントは残す
            

            $table->text('body')->nullable(); // 内容やメモ
            $table->boolean('is_planned')->default(false); // 予定か実施か（デフォルト: 実施）
            $table->date('date'); // イベント日

            $table->timestamps(); // created_at / updated_at 自動生成
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events'); // テーブルを削除
    }
};
