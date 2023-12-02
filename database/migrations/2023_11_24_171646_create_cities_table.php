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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city_name');
            $table->string('city_state')->nullable();
            $table->string('city_slug')->nullable();
            $table->string('city_lat')->nullable();
            $table->string('city_lng')->nullable();
            $table->string('city_image')->nullable();
            $table->longText('city_about')->nullable();
            $table->foreignId('state_id')->index();
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
        Schema::dropIfExists('cities');
    }
};
