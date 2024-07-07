<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('wallets')) {

            Schema::create('wallets', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->decimal('company_pf', 20, 6)->default(0)->nullable();
                $table->decimal('employee_pf', 20, 6)->default(0)->nullable();
                $table->decimal('pf_interest', 20, 6)->default(0)->nullable();
                $table->decimal('gratuity', 20, 6)->default(0)->nullable();
                $table->decimal('welfare', 20, 6)->default(0)->nullable();
                $table->decimal('balance', 20, 6)->default(0)->nullable();
                $table->timestamps();
            });
        }


        if (! Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->string('trx_id')->nullable();
                $table->date('date')->nullable();
                $table->enum('type', [ 'welfare', 'Loan', 'installment', 'salary_advance', 'company_pf', 'employee_pf', 'gratuity'])->nullable();
                $table->string('title')->nullable();
                $table->decimal('debit', 20, 6)->default(0)->nullable();
                $table->decimal('credit', 20, 6)->default(0)->nullable();
                $table->integer('created_by')->default(0)->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('transactions');
    }
}
