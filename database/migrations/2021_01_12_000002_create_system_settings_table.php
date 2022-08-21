<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('system_settings')) {
            Schema::create('system_settings', function(Blueprint $table) {
                $table->id();
                $table->string('system_name')->nullable();
                $table->string('system_phone')->nullable();
                $table->string('system_email')->nullable();
                $table->json('sms_events')->nullable();
                $table->string('email_notification')->nullable();
                $table->integer('pagination')->default(25);
                $table->tinyInteger('use_cache')->default(0);
                $table->integer('report_pagination')->default(100);
                $table->integer('timezone_id')->nullable();
                $table->integer('currency_id')->nullable();
                $table->tinyInteger('show_currency_symbol')->default(0)->nullable();
                $table->tinyInteger('show_space_after_symbol')->default(0)->nullable();
                $table->tinyInteger('has_tax_policy')->default(0)->nullable();
                $table->tinyInteger('system_realtime_notification')->default(0)->nullable();
                $table->mediumText('mix')->nullable();
                $table->string('login_image')->nullable();
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
        Schema::dropIfExists('system_settings');
    }
}
