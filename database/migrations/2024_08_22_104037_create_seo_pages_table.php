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
        if (! Schema::hasTable('seo_pages'))
        {
            Schema::create('seo_pages', function (Blueprint $table)
            {

                $table->id();
                $table->integer('page_id');
                $table->string('slug')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->text('keywords')->nullable();
                $table->string('author')->nullable();
                $table->string('section')->nullable();
                $table->string('canonical')->nullable();
                $table->string('og_locale')->nullable();
                $table->string('og_url')->nullable();
                $table->string('og_type')->nullable();
                $table->string('type')->nullable();
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
        Schema::dropIfExists('seo_pages');
    }
};
