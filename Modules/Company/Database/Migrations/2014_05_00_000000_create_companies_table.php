<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


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
            //$table->integer('yearly_leave')->default(10)->nullable();
            $table->string('employee_id_prefix', 10)->nullable();
            $table->integer('employee_id_length')->default(6)->nullable();
            $table->tinyInteger('has_provision_period')->default(0);
            $table->tinyInteger('has_tax_policy')->default(0)->nullable();
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
            //wallet settings!
            $table->tinyInteger('has_provident_fund')->default(0)->nullable();
            $table->decimal('employee_pf', 10, 2)->default(0)->nullable();
            $table->decimal('company_pf', 10, 2)->default(0)->nullable();
            $table->tinyInteger('has_welfare_fund')->default(0)->nullable();
            $table->decimal('has_welfare_amount', 10, 2)->default(0)->nullable();
            $table->tinyInteger('has_gratuity')->default(0)->nullable();
            $table->integer('gratuity_apply_after')->default(0)->nullable();
            //End wallet setting
            //Increment:
            $table->tinyInteger('has_increment')->default(0)->nullable();
            $table->tinyInteger('has_efficient_bar')->default(0)->nullable();
            $table->integer('increment_year')->default(0)->nullable();
            $table->integer('efficient_bar_year')->default(0)->nullable();
            //Increment
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
