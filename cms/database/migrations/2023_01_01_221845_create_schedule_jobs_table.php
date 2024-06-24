<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('schedule_jobs'))
        {
            Schema::create('schedule_jobs', function(Blueprint $table)
            {
                $table->bigIncrements('id');
                $table->string('class')->nullable();
                $table->string('class_id')->nullable();
                $table->enum('action', ['create', 'update', 'delete'])->nullable();
                $table->date('action_date')->nullable();
                $table->json('data')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shcedule_jobs');
    }
}
