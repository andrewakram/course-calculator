<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->references('id')->nullable()->on('courses')->onDelete('cascade');
            $table->bigInteger('country_id')->nullable();
            $table->foreignId('city_id')->references('id')->nullable()->on('cities')->onDelete('cascade');
            $table->bigInteger('no_of_weeks')->default(1);
            $table->double('price_per_week')->default(1);
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
        Schema::dropIfExists('city_courses');
    }
}
