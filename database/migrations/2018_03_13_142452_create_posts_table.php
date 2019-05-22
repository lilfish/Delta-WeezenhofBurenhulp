<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titel', 120);
            $table->text('content');
            $table->integer('gebruiker_id');
            $table->string('directory');
            $table->string('hash');
            $table->string('delete_hash');
            $table->string('afhandel_hash');
            $table->boolean('verified')->default(0);
            $table->integer('category_id');
            $table->boolean('afgehandeld');
            $table->boolean('deleted')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
