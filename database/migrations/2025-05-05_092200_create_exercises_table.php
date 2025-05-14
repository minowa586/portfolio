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
        Schema::create('exercises', function (Blueprint $table) {
            $table->bigIncrements('id'); // 主キー
            $table->foreignId('user_id') // 登録したユーザーID
                  ->constrained()        // users テーブルと外部キー制約
                  ->onDelete('cascade'); // ユーザー削除時に一緒に削除

            $table->string('name');      // 種目名（ベンチプレスなど）
            $table->softDeletes();       // deleted_at による論理削除
            $table->timestamps();        // created_at / updated_at 自動追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises'); // ロールバック時に削除
    }
};

