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
        Schema::table('products', function (Blueprint $table) {
            $table->float('start_price')->default(0)->after('slug');
            $table->float('buy_now_price')->default(0)->after('start_price');
            $table->float('current_price')->default(0)->after('buy_now_price');
            $table->float('bid_price')->default(0)->after('current_price');
            $table->unsignedBigInteger('winner_id')->default(0)->after('bid_price');
            $table->foreign('winner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
