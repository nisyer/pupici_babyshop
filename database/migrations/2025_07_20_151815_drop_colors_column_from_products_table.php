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
        if (Schema::hasColumn('products', 'colors')) {
            $table->dropColumn('colors');
        }
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('colors')->nullable();
    });
}

            //

};
