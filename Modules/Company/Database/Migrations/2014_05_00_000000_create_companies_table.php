<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('details')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
        });

        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('com_id')->unsigned()->nullable();
            $table->integer('yearly_leave')->default(10)->nullable();
            $table->string('employee_id_prefix', 10)->nullable();
            $table->integer('employee_id_length')->default(6)->nullable();
            $table->tinyInteger('has_provision_period')->default(0);
            //$table->tinyInteger('has_provident_fund')->default(0);
            //$table->tinyInteger('has_insurance')->default(0);
            $table->tinyInteger('allow_overtime')->default(0);
            $table->enum('attendance', ['ip_based', 'manual'])->nullable();
            $table->tinyInteger('has_attendance_deduction_policy')->default(0);
            $table->tinyInteger('has_allowances')->default(0);
            $table->tinyInteger('allow_employee_login')->default(0);
            $table->tinyInteger('allow_holiday_work_as_overtime')->default(0);
            $table->tinyInteger('enable_device', )->default(0)->nullable();
            $table->tinyInteger('allow_bulk_upload')->default(0)->nullable();
            $table->string('default_password')->default('123456')->nullable();
            //$table->decimal('provident_fund_company_amount', 20, 2)->default(0)->nullable();
            //$table->tinyInteger('provident_fund_company_amount_percent')->default(0)->nullable();
            $table->string('device_ip', 20)->nullable();
            $table->timestamps();
            $table->foreign('com_id')->references('id')->on('companies')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_settings');
    }
}
