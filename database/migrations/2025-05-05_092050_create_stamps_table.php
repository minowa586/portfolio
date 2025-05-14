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
        Schema::create('stamps', function (Blueprint $table) {
            $table->id(); // 主キー（自動増分）

            $table->string('name'); // スタンプの名前
            $table->string('image_path'); // スタンプ画像のファイルパス（例: /images/stamps/fire.png）

            $table->timestamps(); // created_at / updated_at 自動追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stamps'); // ロールバック時にテーブル削除
    }
};

