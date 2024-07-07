<?php

use \Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (! Schema::hasTable('activity_log')){
            Schema::create('activity_log', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('user_id')->unsigned()->nullable();
                $table->string('table')->nullable();
                $table->integer('row_id')->nullable();
                $table->integer('action_id')->nullable();
                $table->text('title');
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies');
                $table->foreign('branch_id')->references('id')->on('branches');
                $table->foreign('user_id')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('activity_log');
    }
}
