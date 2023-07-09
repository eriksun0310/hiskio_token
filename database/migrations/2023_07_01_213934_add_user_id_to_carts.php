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
        Schema::table('carts', function (Blueprint $table) {
            //foreignId確定有user_id
            //確定有user_id,才去對應users這張表的id欄位,再去把 user_id 加入 carts
            //(users.id === carts.user_id)
            $table->foreignId('user_id')->constrained('users')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            //先把上面的限制拿掉,在取消
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
