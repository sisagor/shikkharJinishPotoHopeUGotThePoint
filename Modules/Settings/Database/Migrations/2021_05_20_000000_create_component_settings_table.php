<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ##Blog categories
        if (! Schema::hasTable('blog_categories'))
        {
            Schema::create('blog_categories', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->string('name');
                $table->mediumText('details')->nullable();
                $table->tinyInteger('status')->default(0)->nullable();
                $table->softDeletes();
                $table->timestamps();
                //$table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
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
        Schema::dropIfExists('blog_categories');
    }
}
