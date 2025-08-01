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
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); // order_id
        $table->unsignedBigInteger('customer_id'); // FK kepada customer
        $table->date('date');
        $table->string('status')->default('pending');
        $table->timestamps();

        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
