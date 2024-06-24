<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('addresses')) {
            Schema::create('addresses', function(Blueprint $table) {
                $table->bigIncrements('id');
                $table->enum('type', ['primary', 'present', 'permanent'])->default('primary');
                $table->longText('address')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('country_id')->nullable();
                $table->unsignedInteger('addressable_id');
                $table->string('addressable_type');
                $table->tinyInteger('status')->default(0)->nullable();
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
        Schema::dropIfExists('addresses');
    }

}
