<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->enum('type', ['user', 'teacher'])->default('user');
            $table->tinyInteger('active')->default(0)->comment('0->unactive and 1->Active');
            $table->tinyInteger('suspend')->default(0)->comment('0->unsuspended and 1->suspended');
            $table->enum('provider', ['google', 'facebook', 'other'])->default('other');
            $table->longText('social_id')->nullable();
            $table->bigInteger('points')->nullable();
            $table->enum('gender', ['male', 'femail'])->default('male');
            $table->string('nationality')->nullable();
            $table->bigInteger('rate')->default('0');
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
