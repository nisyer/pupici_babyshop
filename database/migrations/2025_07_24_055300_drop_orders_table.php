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
    Schema::dropIfExists('orders');
}

public function down(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        // Tambah balik columns asal kalau nak support rollback
    });
}

};
