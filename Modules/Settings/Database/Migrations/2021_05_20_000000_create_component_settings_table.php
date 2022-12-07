<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('employee_types')) {
            Schema::create('employee_types', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('name')->nullable();
                $table->tinyInteger('allow_company_facility')->default(0)->nullable();
                $table->text('details')->nullable();
                $table->tinyInteger('status')->default(0);
                $table->integer('created_by')->default(0);
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('leave_types')) {
            Schema::create('leave_types', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('name')->nullable();
                $table->string('type', 20)->nullable();
                $table->integer('days')->nullable();
                $table->text('details')->nullable();
                $table->tinyInteger('status')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('taxes')) {
            Schema::create('taxes', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->decimal('eligible_amount', 20, 6)->nullable();
                $table->decimal('tax', 6, 2)->nullable();
                $table->tinyInteger('status')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('shifts')) {
            Schema::create('shifts', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('type');
                $table->string('name');
                $table->time('start_time');
                $table->time('end_time');
                $table->decimal('working_hour', 6, 2)->nullable();
                $table->text('details')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->integer('created_by')->default(1);
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('holidays')) {
            Schema::create('holidays', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('occasion');
                $table->date('start_date');
                $table->date('end_date');
                $table->integer('days');
                $table->year('holiday_year')->nullable();
                $table->string('holiday_month', 10)->nullable();
                $table->tinyInteger('status')->default(0);
                $table->integer('created_by')->default(0);
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('job_categories')) {
            Schema::create('job_categories', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('name');
                $table->mediumText('details')->nullable();
                $table->tinyInteger('status')->default(0)->nullable();
                $table->softDeletes();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
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
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('taxes');
        Schema::dropIfExists('holidays');
        Schema::dropIfExists('shifts');
        Schema::dropIfExists('employee_types');
        Schema::dropIfExists('job_categories');
    }
}
