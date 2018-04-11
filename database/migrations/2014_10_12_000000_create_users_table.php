<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up() : void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('twitter_id');
            $table->string('token');
            $table->string('token_secret');
            $table->string('name');
            $table->string('nickname');
            $table->string('avatar');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('users');
    }
}
