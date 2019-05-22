<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('gebruiker_id');
            $table->string('titel');
            $table->string('hash');
            $table->boolean('verified')->default(0);
            $table->date('datum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_replies');
    }
}
