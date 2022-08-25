<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('sms_log')) {
            Schema::create('sms_log', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->mediumText('sms')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->softDeletes();
                $table->integer('created_by')->default(0);
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('SET NULL');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('email_log')) {
            Schema::create('email_log', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('subject')->nullable();
                $table->string('email')->nullable();
                $table->json('body')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->integer('created_by')->default(0);
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('SET NULL');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('schedule_email_sms')) {
            Schema::create('schedule_email_sms', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->enum('type', ['email', 'sms'])->nullable();
                $table->json('details')->nullable();
                $table->tinyInteger('status')->default(0);
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('SET NULL');
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
        Schema::dropIfExists('sms_log');
    }
}
