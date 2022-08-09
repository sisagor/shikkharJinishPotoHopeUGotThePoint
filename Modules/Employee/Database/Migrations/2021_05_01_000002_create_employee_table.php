<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('employees')) {
            Schema::create('employees', function (Blueprint $table) {
                $table->id();
                $table->string('employee_index')->nullable();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('department_id')->unsigned()->nullable();
                $table->bigInteger('designation_id')->unsigned()->nullable();
                $table->bigInteger('shift_id')->unsigned()->nullable();
                $table->bigInteger('type_id')->unsigned()->nullable();
                $table->bigInteger('leave_policy_id')->unsigned()->nullable();
                $table->integer('provision_period')->nullable();
                $table->tinyInteger('allow_overtime')->nullable();
                $table->decimal('overtime_allowance', 6, 2)->nullable();
                $table->tinyInteger('allowance_percent')->nullable();
                $table->date('joining_date')->nullable();
                //$table->date('provident_maturity_date')->nullable();
                //$table->date('insurance_maturity_date')->nullable();
                $table->tinyInteger('is_terminate')->nullable();
                $table->date('termination_date')->nullable();
                $table->decimal('basic_salary', 20, 6)->default(0)->nullable();
                $table->string('name')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->date('dob')->nullable();
                $table->enum('gender', ['Male', "Female", "Other"])->nullable();
                $table->enum('marital_status', ['Single', "Married", "Widowed"])->default("Single")->nullable();
                $table->string('card_no')->nullable();
                $table->tinyInteger('status')->nullable();
                $table->string('device_id', 10)->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->tinyInteger('is_updated')->nullable();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('SET NULL');

            });
        }

        if (! Schema::hasTable('employee_educations')) {
            Schema::create('employee_educations', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('exam_title')->nullable();
                $table->string('institute')->nullable();
                $table->string('passing_year')->nullable();
                $table->string('cgpa')->nullable();
                $table->string('out_of')->nullable();
                $table->tinyInteger('status')->default(0)->nullable();
                $table->timestamps();
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            });
        }

        /* if (! Schema::hasTable('employee_leaves')) {
             Schema::create('employee_leaves', function (Blueprint $table) {
                 $table->id();
                 $table->bigInteger('employee_id')->unsigned()->nullable();
                 $table->bigInteger('type_id')->unsigned()->nullable();
                 $table->integer('leave_days')->nullable();
                 $table->integer('taken_days')->nullable();
                 $table->integer('available_days')->nullable();
                 $table->integer('created_by')->nullable();
                 $table->timestamps();
                 $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

             });
         }*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employee_educations');
        Schema::dropIfExists('employee_leaves');
    }
}
