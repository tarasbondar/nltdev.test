<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Init extends Migration
{

    public function up()
    {

        /*Schema::table('users', function (Blueprint $table) {

        });*/

        Schema::create('contacts', function (Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('phone')->default('');
            $table->timestamps();
        });

        Schema::create('notes', function (Blueprint $table){
            $table->id();
            $table->string('note');
            $table->bigInteger('notable_id');
            $table->string('notable_type', 127);
            $table->timestamps();
        });

        Schema::create('address_book', function (Blueprint $table){
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('contact_id')->references('id')->on('contacts')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'contact_id']);
        });

    }

    public function down()
    {
        Schema::dropIfExists('address_book');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('contacts');

    }
}
