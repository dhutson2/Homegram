<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); // this helps us know who owns the profile
            // in other 'foreign' tables.. called a foreign key
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->index('user_id'); // add an index for any form key in table (Unsign)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //this means migration is running backwards, you are reversing what you did
    { // this will just delete another profiles table if we create it since we already have one
        Schema::dropIfExists('profiles');
    }
}
