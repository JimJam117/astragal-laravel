<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('thumbnail')->default('blank');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('thumbnail')->default('blank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('thumbnail')->default('blank');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('thumbnail')->default('blank');
        });
    }
}
