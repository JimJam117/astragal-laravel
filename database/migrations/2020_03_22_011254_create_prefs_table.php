<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('main_text')->nullable();
            $table->text('sub_text')->nullable();

            $table->string('background_image_location')->nullable();
            $table->string('profile_pic_location')->nullable();

            $table->text('landing_page_title')->nullable();
            $table->text('landing_page_text')->nullable();
            $table->text('about_section')->nullable();

            $table->integer('number_of_recent_posts_to_display')->nullable();
            $table->integer('Featured_Image_1_Gal_ID')->nullable();
            $table->integer('Featured_Image_2_Gal_ID')->nullable();
            $table->integer('Featured_Image_3_Gal_ID')->nullable();

            $table->string('facebook_link')->nullable();
            $table->string('email_address')->nullable();
            $table->string('instagram_link')->nullable();

            $table->boolean('bool_is_facebook_enabled')->nullable();
            $table->boolean('bool_is_email_enabled')->nullable();
            $table->boolean('bool_is_instagram_enabled')->nullable();
            $table->boolean('bool_is_aboutme_enabled')->nullable();
            $table->boolean('bool_is_landingsubtext_enabled')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prefs');
    }
}
