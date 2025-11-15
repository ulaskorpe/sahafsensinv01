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
        Schema::create('keywordables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keyword_id');
            $table->unsignedBigInteger('product_id')->default(0);
            $table->unsignedBigInteger('blog_id')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->timestamps();

            // $table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');

            // $table->index(['keyword_id', 'product_id']);
            // $table->index(['keyword_id', 'blog_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keywordables');
    }
};
