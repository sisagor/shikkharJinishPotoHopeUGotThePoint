<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('job_postings')) {
            Schema::create('job_postings', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->string('position');
                $table->longText('details')->nullable();
                $table->longText('requirements')->nullable();
                $table->tinyInteger('vacancy')->nullable();
                $table->tinyInteger('experience')->nullable();
                $table->string('salary_rang')->nullable();
                $table->string('job_location')->nullable();
                $table->date('expire_date')->nullable();
                $table->enum('status', ['open', 'closed'])->default('open')->nullable();
                $table->softDeletes();
                $table->timestamps();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('SET NULL');
                $table->foreign('category_id')->references('id')->on('job_categories')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('job_applications')) {
            Schema::create('job_applications', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('job_id')->unsigned()->nullable();
                $table->string('name')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->unique();
                $table->double('expected_salary', 10,2)->nullable();
                $table->longText('cover_later')->nullable();
                $table->double('negotiated_salary', 10,2)->nullable();
                $table->longText('offer_later')->nullable();
                $table->date('expected_joining_date')->nullable();
                $table->enum('status', ['pending', 'approved', 'rejected', 'interview', 'offer_job', 'confirmed'])->default('pending');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('SET NULL');
                $table->foreign('job_id')->references('id')->on('job_postings')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('job_interviews')) {
            Schema::create('job_interviews', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('job_id')->unsigned()->nullable();
                $table->bigInteger('job_application_id')->unsigned()->nullable();
                $table->date('interview_date')->nullable();
                $table->time('interview_time')->nullable();
                $table->json('interviewers')->nullable();
                $table->string('address')->nullable();
                $table->mediumText('details')->nullable();
                $table->enum('status', ['scheduled', 'pass', 'fail'])->default('scheduled');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('SET NULL');
                $table->foreign('job_id')->references('id')->on('job_postings')->onDelete('SET NULL');
                $table->foreign('job_application_id')->references('id')->on('job_applications')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('job_offers')) {
            Schema::create('job_offers', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('com_id')->unsigned()->nullable();
                $table->bigInteger('branch_id')->unsigned()->nullable();
                $table->bigInteger('job_id')->unsigned()->nullable();
                $table->bigInteger('job_application_id')->unsigned()->nullable();
                $table->string('title')->nullable();
                $table->mediumText('details')->nullable();
                $table->enum('status', ['pending', 'confirmed'])->default('pending');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('com_id')->references('id')->on('companies')->onDelete('SET NULL');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('SET NULL');
                $table->foreign('job_id')->references('id')->on('job_postings')->onDelete('SET NULL');
                $table->foreign('job_application_id')->references('id')->on('job_applications')->onDelete('SET NULL');
            });
        }

        if (! Schema::hasTable('cms')) {
            Schema::create('cms', function (Blueprint $table) {
                $table->id();
                $table->string('type')->nullable();
                $table->json('content')->nullable();
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
        Schema::dropIfExists('job_postings');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_interviews');
        Schema::dropIfExists('job_offers');
        Schema::dropIfExists('cms');
    }
}
