<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('profiles')) {
            Schema::create('profiles', function (Blueprint $table) {
                $table->id();
                $table->integer('com_id')->nullable();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->date('dob')->nullable();
                $table->string('gender')->nullable();
                $table->string('address')->nullable();
                $table->string('occupation')->nullable();
                $table->text('about')->nullable();
                $table->string('facebook')->nullable();
                $table->string('twitter')->nullable();
                $table->string('instagram')->nullable();
                $table->string('linkedin')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('created_by')->nullable();
                $table->softDeletes();
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
        Schema::dropIfExists('profiles');
    }
};
