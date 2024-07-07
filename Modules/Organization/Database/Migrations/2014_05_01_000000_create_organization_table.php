<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('departments')) {
            Schema::create('departments', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('name');
                $table->string('details')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->integer('created_by')->default(0);
            });
        }

        if (! Schema::hasTable('designations')) {
            Schema::create('designations', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('department_id')->unsigned()->nullable();
                $table->string('name');
                $table->string('details')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->softDeletes();
                $table->integer('created_by')->default(0);
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('SET NULL');;

            });
        }

        if (! Schema::hasTable('attendance_deduction_policies')) {
            Schema::create('attendance_deduction_policies', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('type', 20)->nullable();
                $table->integer('absent')->nullable();
                $table->decimal('deduction_amount', 6, 2)->nullable();
                $table->tinyInteger('is_percent')->nullable()->default(0);
                $table->text('details')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->integer('created_by')->default(0);
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('CASCADE');
            });
        }

        if (! Schema::hasTable('leave_policies')) {
            Schema::create('leave_policies', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->json('type_id')->nullable();
                $table->string('name')->nullable();
                $table->integer('days')->nullable();
                $table->enum('apply_at', ['joining_date', 'after_provision'])->default('after_provision');
                $table->text('details')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->integer('created_by')->default(0);
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('CASCADE');
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
        Schema::dropIfExists('departments');
        Schema::dropIfExists('designations');
        Schema::dropIfExists('attendance_deduction_policies');
        Schema::dropIfExists('leave_policies');
    }
}
