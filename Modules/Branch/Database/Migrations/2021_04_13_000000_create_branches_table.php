<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('com_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
        });

        Schema::create('branch_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('com_id')->unsigned()->nullable();
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->tinyInteger('allow_employee_login')->nullable();
            $table->tinyInteger('allow_overtime')->nullable();
            $table->enum('attendance', ['ip_based', 'manual'])->nullable();
            $table->string('device_ip', 20)->nullable();
            $table->tinyInteger('enable_device', )->default(0)->nullable();
            $table->timestamps();
            $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
        Schema::dropIfExists('branch_settings');
    }
}
