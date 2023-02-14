<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (! Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('manager_id')->unsigned()->nullable();
                $table->string('name')->nullable();
                $table->mediumText('details')->nullable();
                $table->tinyInteger('status')->default(0);
                $table->integer('created_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('manager_id')->references('id')->on('users');
                /*  $table->foreign('com_id')->references('id')->on('company');
                  $table->foreign('branch_id')->references('id')->on('branches');*/
            });
        }

        if (! Schema::hasTable('billings')) {
            Schema::create('billings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('project_id')->unsigned()->nullable();
                $table->bigInteger('manager_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('title')->nullable();
                $table->string('office_id')->nullable();
                $table->string('site_id')->nullable();
                $table->decimal('mobile_bill', 10, 2)->nullable();
                $table->decimal('allowance', 10, 2)->nullable();
                $table->mediumText('allowance_history')->nullable();
                $table->decimal('other_bill', 10, 2)->nullable();
                $table->mediumText('other_bill_history')->nullable();
                $table->decimal('total', 10,2)->nullable();
                $table->tinyInteger('status')->default(0);
                $table->integer('approve_one')->nullable();
                $table->integer('approve_two')->nullable();
                $table->timestamp('approve_one_date')->nullable();
                $table->timestamp('approve_two_date')->nullable();
                $table->integer('created_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('project_id')->references('id')->on('projects');
            /* $table->foreign('manager_id')->references('id')->on('users');
                $table->foreign('com_id')->references('id')->on('company');
                $table->foreign('branch_id')->references('id')->on('branches');*/
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('projects');
        Schema::drop('billings');
    }
}
