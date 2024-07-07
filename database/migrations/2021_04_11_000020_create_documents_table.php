<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('documents')) {
            Schema::create('documents', function(Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name')->nullable();
                $table->string('doc_name')->nullable();
                $table->text('path')->nullable();
                $table->string('ext')->nullable();
                $table->string('size')->nullable();
                $table->integer('order')->default(0);
                $table->unsignedInteger('documentable_id');
                $table->string('documentable_type');
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
        Schema::dropIfExists('documents');
    }

}
