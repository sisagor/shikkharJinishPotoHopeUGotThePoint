<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('modules')) {
            Schema::create('modules', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->json('scope')->nullable();
                $table->string('icon')->nullable();
                $table->string('url')->nullable();
                $table->integer('order')->nullable()->default(0);
                $table->tinyInteger('status')->default(1);
            });
        }


        if(! Schema::hasTable('submodules')) {
            Schema::create('submodules', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('module_id')->unsigned()->nullable();
                $table->string('name');
                $table->json('scope')->nullable();
                $table->integer('order')->nullable()->default(0);
                $table->tinyInteger('show')->default(1);
                $table->tinyInteger('status')->default(1);
                $table->foreign('module_id')->references('id')->on('modules');
            });
        }


        if(! Schema::hasTable('menu')) {
            Schema::create('menu', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('submodule_id')->unsigned()->nullable();
                $table->string('name');
                $table->string('url')->nullable();
                $table->string('action')->nullable();
                $table->tinyInteger('show')->default(0);
                $table->foreign('submodule_id')->references('id')->on('submodules');
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
        Schema::dropIfExists('modules');
        Schema::dropIfExists('submodules');
        Schema::dropIfExists('menu');
    }
}
