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
        Schema::create('site_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->enum('source', ['App\Models\Product', 'App\Models\Blog']);
            $table->dateTime('valid_until')->default(now()->addMonths(3));
            $table->enum('type',['carousel','offer','featured','recent']);
            $table->integer('rank');
            $table->softdeletes();
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_items');
    }
};
