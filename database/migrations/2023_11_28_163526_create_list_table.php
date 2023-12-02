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
        Schema::create('list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->index();
            $table->json('sub_category_ids');
            $table->string('title');
            $table->string('slug');
            $table->foreignId('country_id')->index();
            $table->foreignId('state_id')->index();
            $table->foreignId('city_id')->index();
            $table->foreignId('area_id')->index();
            $table->string('post_code')->nullable();
            $table->longText('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('youtube_video_id')->nullable();
            $table->longText('description')->nullable();
            $table->string('website')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_whatsapp_url')->nullable();
            $table->string('whatsapp_chat')->nullable();
            $table->string('email_id')->nullable();
            $table->string('price_range')->nullable();
            $table->json('general_features')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('appointment')->nullable();
            $table->json('wifi')->nullable();
            $table->json('parking')->nullable();
            $table->string('banner_image_url')->nullable();
            $table->string('feature_image_url')->nullable();
            $table->longText('hours')->nullable();
            $table->integer('item_status')->default(1);
            $table->boolean('item_featured')->default(0);
            $table->boolean('item_featured_by_admin')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list');
    }
};
