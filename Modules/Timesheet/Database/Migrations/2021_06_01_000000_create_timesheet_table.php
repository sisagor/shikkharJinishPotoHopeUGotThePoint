<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateTimesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('leave_applications')) {
            Schema::create('leave_applications', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('type_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->enum('leave_for', ['days', 'hour'])->default('days')->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->date('leave_hour_date')->nullable();
                $table->decimal('leave_hour', 6, 2)->nullable();
                $table->text('details')->nullable();
                $table->integer('leave_days')->nullable();
                $table->integer('created_by')->default(0);
                $table->tinyInteger('approval_status')->default(0)->nullable();
                $table->integer('approved_by')->default(0)->nullable();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
                $table->foreign('type_id')->references('id')->on('leave_types')->onDelete('NO ACTION');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('NO ACTION');
            });
        }


        if (! Schema::hasTable('attendances')) {
            Schema::create('attendances', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('device_ip')->nullable();
                $table->dateTime('checkin_time')->nullable();
                $table->dateTime('checkout_time')->nullable();
                $table->date('attendance_date')->nullable();
                $table->decimal('overtime', 6, 2)->nullable();
                $table->decimal('working_hour', 6, 2)->nullable();
                $table->decimal('late', 6, 2)->default(0)->nullable();
                $table->tinyInteger('status')->default(0)->nullable();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('NO ACTION');
            });
        }

        if (! Schema::hasTable('attendance_log')) {
            Schema::create('attendance_log', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('device_ip')->nullable();
                $table->dateTime('punch_time')->nullable();
                $table->string('state')->nullable();
                $table->string('type')->nullable();
                $table->mediumText('location')->nullable();
                $table->decimal('latitude', 10, 8)->nullable();
                $table->decimal('longitude', 11, 8)->nullable();
                $table->tinyInteger('status')->default(0)->nullable();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('NO ACTION');
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
        Schema::dropIfExists('leave_applications');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('attendance_log');
        Schema::dropIfExists('absent_log');
    }
}
