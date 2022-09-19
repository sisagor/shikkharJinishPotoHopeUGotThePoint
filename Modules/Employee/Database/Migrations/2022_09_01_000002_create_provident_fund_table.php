<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateProvidentFundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('provident_funds')) {
            Schema::create('provident_funds', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('employee_id')->unsigned()->nullable();
                $table->decimal('employee_pf', 20, 6)->default(0)->nullable();
                $table->decimal('company_pf', 20, 6)->default(0)->nullable();
                $table->decimal('total', 20, 6)->default(0)->nullable();
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
        Schema::dropIfExists('provident_funds');
    }
}
