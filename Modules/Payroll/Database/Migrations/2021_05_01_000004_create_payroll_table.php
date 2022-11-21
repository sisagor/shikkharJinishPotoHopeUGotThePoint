<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreatePayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (! Schema::hasTable('salary_structures')) {
            Schema::create('salary_structures', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('type');
                $table->string('name');
                $table->tinyInteger('status')->default(1);
                $table->integer('created_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
            });
        }

        if (! Schema::hasTable('salary_rules')) {
            Schema::create('salary_rules', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('designation_id')->unsigned()->nullable();
                $table->string('name');
                $table->decimal('basic_salary', 20, 6);
                $table->decimal('increment_amount', 10, 6);
                $table->decimal('efficient_bar_amount', 10, 6);
                $table->string('details');
                $table->json('components');
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->softDeletes();
                $table->integer('created_by')->default(0);
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
                $table->foreign('designation_id')->references('id')->on('designations')->onDelete('NO ACTION');
            });
        }


        if (! Schema::hasTable('salary_rule_structures')) {
            Schema::create('salary_rule_structures', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('salary_rule_id')->unsigned()->nullable();
                $table->bigInteger('salary_structure_id')->unsigned()->nullable();
                $table->tinyInteger('is_percent')->default(0);
                $table->decimal('amount', 20, 6)->default(0);
                $table->foreign('salary_rule_id')->references('id')->on('salary_rules')->onDelete('CASCADE');
                $table->foreign('salary_structure_id')->references('id')->on('salary_structures')->onDelete('CASCADE');
            });
        }

        if (! Schema::hasTable('salaries')) {
            Schema::create('salaries', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('salary_rule_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('month')->nullable();
                $table->decimal('basic_salary', 20, 6)->default(0)->nullable();
                $table->decimal('allowance', 20, 6)->default(0)->nullable();
                $table->decimal('deduction', 20, 6)->default(0)->nullable();
                $table->decimal('other_allowance', 20, 6)->default(0)->nullable();
                $table->decimal('other_deduction', 20, 6)->default(0)->nullable();
                $table->longText('details')->nullable();
                $table->decimal('tax', 20, 6)->nullable();
                $table->decimal('total', 20, 6)->default(0)->nullable();
                $table->decimal('gross_amount', 20, 6)->default(0)->nullable();
                $table->decimal('net_amount', 20, 6)->default(0)->nullable();
                $table->decimal('paid_amount', 20, 6)->default(0)->nullable();
                $table->decimal('due_amount', 20, 6)->default(0)->nullable();
                $table->tinyInteger('is_paid')->default(0)->nullable();
                $table->tinyInteger('approval_status')->default(0)->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('salary_rule_id')->references('id')->on('salary_rules')->onDelete('NO ACTION');
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('NO ACTION');
            });
        }

       /* if (! Schema::hasTable('salary_details')) {
            Schema::create('salary_details', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('salary_id')->unsigned()->nullable();
                $table->string('key');
                $table->string('value');
                $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('CASCADE');
            });
        }*/

       /* if (! Schema::hasTable('salary_advance')) {
            Schema::create('salary_advance', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('month')->nullable();
                $table->decimal('advance_amount', 20, 6)->default(0);
                $table->date('taken_date')->nullable();
                $table->date('deduct_amount', 20, 6)->default(0);
                $table->date('deduct_amount_percent', 20, 6)->default(0);
                $table->date('maturity_date')->nullable();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('NO ACTION');
            });
        }*/

       /* if (! Schema::hasTable('provident_fund')) {
            Schema::create('provident_fund', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('employee_index')->nullable();
                $table->string('employee_name')->nullable();
                $table->string('month')->nullable();
                $table->decimal('employee_amount', 20, 6)->default(0);
                $table->decimal('company_amount', 20, 6)->default(0);
                $table->decimal('total', 20, 6)->default(0);
                $table->date('maturity_date')->nullable();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('NO ACTION');
            });
        }*/

       /* if (! Schema::hasTable('insurance')) {
            Schema::create('insurance', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('employee_index')->nullable();
                $table->string('employee_name')->nullable();
                $table->string('month')->nullable();
                $table->decimal('employee_amount', 20, 6)->default(0);
                $table->decimal('company_amount', 20, 6)->default(0);
                $table->decimal('total', 20, 6)->default(0);
                $table->date('maturity_date')->nullable();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('NO ACTION');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('NO ACTION');
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
        Schema::dropIfExists('salary_structures');
        Schema::dropIfExists('salary_rules');
        Schema::dropIfExists('salary_rule_structures');
        //Schema::dropIfExists('provident_fund');
        //Schema::dropIfExists('insurance');
        Schema::dropIfExists('salary_advance');
    }
}
