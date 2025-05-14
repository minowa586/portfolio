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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // 主キー

            $table->string('name'); // ユーザー名
            $table->string('email')->unique(); // メールアドレス（ユニーク制約付き）
            $table->timestamp('email_verified_at')->nullable(); // メール確認日時（オプション）
            $table->string('password'); // パスワード（ハッシュ化された値）

            $table->rememberToken(); // remember_token カラム（ログイン維持用、nullable）

            $table->timestamps(); // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // テーブル削除
    }
};

