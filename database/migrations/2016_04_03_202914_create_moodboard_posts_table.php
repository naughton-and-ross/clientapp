<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoodboardPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moodboard_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('moodboard_id');
            $table->integer('user_id');
            $table->integer('client_id');
            $table->integer('project_id');
            $table->string('post_type');
            $table->string('img_loc')->nullable();
            $table->string('text')->nullable();
            $table->string('url')->nullable();
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
        Schema::drop('moodboard_posts');
    }
}
