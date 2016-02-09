<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('client_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('project_update_id')->nullable();
            $table->integer('project_activity_id')->nullable();
            $table->integer('invoice_id')->nullable();
            $table->integer('quote_id')->nullable();
            $table->string('activity_type');
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
        Schema::drop('user_activities');
    }
}
