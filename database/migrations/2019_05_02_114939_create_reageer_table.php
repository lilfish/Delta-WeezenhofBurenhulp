<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReageerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reageer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('original_post_id');
            $table->integer('reageer_gebruiker_id');
            $table->integer('gebruiker_id');
            $table->string('titel');
            $table->string('hash');
            $table->string('delete_hash');
            $table->boolean('verified')->default(0);
            $table->text('content');
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
        Schema::dropIfExists('reageer');
    }
}
