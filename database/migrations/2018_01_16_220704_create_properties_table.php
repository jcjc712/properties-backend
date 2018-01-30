<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('lat');
            $table->string('lng');
            $table->string('administrative_area_level_1');
            $table->string('administrative_area_level_2')->nullable();
            $table->string('administrative_area_level_3')->nullable();
            $table->string('description')->nullable();
            $table->string('country')->nullable();
            $table->string('locality')->nullable();
            $table->string('political')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('route')->nullable();
            $table->string('street_number')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
