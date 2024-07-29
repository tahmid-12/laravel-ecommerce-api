<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Dropping the images Column from the products table
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('images');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // It can be added if images table is necessary or to be added
            Schema::table('products', function (Blueprint $table) {
                $table->string('images');
            });
        });
    }
};
