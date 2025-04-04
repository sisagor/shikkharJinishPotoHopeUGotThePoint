<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('profiles')) {
            Schema::create('profiles', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->date('dob')->nullable();
                $table->string('gender')->nullable();
                $table->string('address')->nullable();
                $table->string('occupation')->nullable();
                $table->string('facebook')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('twitter')->nullable();
                $table->string('instagram')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->integer('created_by')->default(0);
                $table->integer('updated_by')->default(0);
                //$table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('role_id')->unsigned()->nullable();
                $table->bigInteger('profile_id')->unsigned()->nullable();
                $table->string('manager', 10)->nullable();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('level')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
                //$table->foreign('com_id')->references('id')->on('companies')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('SET NULL');
                $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('profiles');
    }
}
