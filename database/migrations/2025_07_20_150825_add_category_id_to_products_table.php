<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        if (!Schema::hasColumn('products', 'category_id')) {
            $table->unsignedBigInteger('category_id')->after('id');

            // Optional: foreign key constraint (boleh skip kalau takut error)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        }
    });
}


public function down()
{
    Schema::table('products', function (Blueprint $table) {
        if (Schema::hasColumn('products', 'category_id')) {
            // Drop column only (skip dropForeign to avoid error)
            $table->dropColumn('category_id');
        }
    });
}


};
