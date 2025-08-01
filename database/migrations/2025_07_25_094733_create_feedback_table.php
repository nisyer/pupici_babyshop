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
    Schema::create('feedback', function (Blueprint $table) {
    $table->id('feedback_id');
    $table->unsignedBigInteger('product_id');
    $table->unsignedBigInteger('customer_id');
    $table->integer('rating'); // 1-5 stars
    $table->text('comment');
    $table->timestamps();

    $table->foreign('product_id')->references('id')->on('products');
    $table->foreign('customer_id')->references('id')->on('customers');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
