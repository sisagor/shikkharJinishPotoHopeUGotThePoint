<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZktecoDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('zkteco_devices'))
        {
            Schema::create('zkteco_devices', function(Blueprint $table) {
                $table->id();
                $table->integer('com_id');
                $table->ipAddress('ip');
                $table->string('port', 10)->default(4370);
                //$table->string('model_name');
                $table->tinyInteger('status')->default(0);
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('zkteco_devices');
    }
}
