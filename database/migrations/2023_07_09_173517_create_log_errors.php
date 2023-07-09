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
        Schema::create('log_errors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0);
            $table->text('exception')->nullable();//exception 例外、nullable():欄位可以是null
            $table->text('message')->nullable();
            $table->integer('line')->nullable();//line 出現的錯誤在第幾行
            $table->json('trace')->nullable();//trace 追蹤紀錄
            $table->string('method')->nullable();//trace 追蹤紀錄
            $table->json('params')->nullable();//params 使用者傳的參數
            $table->text('uri')->nullable();//uri 使用者打的網址
            $table->text('user_agent')->nullable();//user_agent 使用者的瀏覽器
            $table->json('header')->nullable();//header 使用者的屬性
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_errors');
    }
};
