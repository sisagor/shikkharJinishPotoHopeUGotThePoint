<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('loans')) {
            Schema::create('loans', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->enum('type', ['loan', 'advance_salary']);
                $table->double('interest_percent', 6,2)->default(0)->nullable();
                $table->double('loan_amount', 10,2)->default(0)->nullable();
                $table->tinyInteger('installments')->default(0)->nullable();
                $table->double('installment_amount', 10,2)->default(0)->nullable();
                $table->tinyInteger('paid_installment')->default(0)->nullable();
                $table->double('paid_installment_amount', 10,2)->default(0)->nullable();
                $table->mediumText('details')->nullable();
                $table->tinyInteger('is_paid')->default(0)->nullable();
                $table->enum('status', ['pending', 'processing', 'approved', 'released'])->default('pending')->nullable();
                $table->softDeletes();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('CASCADE');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('NO ACTION');
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('NO ACTION');
            });
        }

        if (! Schema::hasTable('loan_installment')) {
            Schema::create('loan_installment', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('loan_id')->unsigned()->nullable();
                $table->string('installment_month')->nullable();
                $table->double('installment_amount', 10,2)->nullable();
                $table->timestamps();
                $table->foreign('loan_id')->references('id')->on('loans')->onDelete('NO ACTION');
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
        Schema::dropIfExists('loans');
        Schema::dropIfExists('loan_installment');
        //Schema::dropIfExists('job_interview');
    }
}
