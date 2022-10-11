<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('role_permissions')) {
            Schema::create('role_permissions', function(Blueprint $table) {
                $table->id();
                $table->bigInteger('role_id')->unsigned()->nullable();
                $table->bigInteger('module_id')->unsigned()->nullable();
                $table->bigInteger('submodule_id')->unsigned()->nullable();
                $table->bigInteger('menu_id')->unsigned()->nullable();
                $table->string('action')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('role_permissions');
    }
}
