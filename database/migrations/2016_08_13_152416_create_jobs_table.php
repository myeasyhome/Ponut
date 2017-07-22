<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @copyright   2016 Clivern
 * @link        http://clivern.com
 * @license     MIT
 * @package     Ponut
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(env('DB_TABLES_PREFIX', '') . 'jobs', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('title', 200);
            $table->string('slug', 250)->unique();
            $table->string('country', 50);
            $table->string('zipcode', 50);
            $table->enum('remote_job', ['yes', 'no']);
            $table->string('seo_keywords', 250);
            $table->string('seo_description', 250);
            $table->text('description');
            $table->text('requirements');
            $table->text('benefits');
            $table->string('job_function', 50);
            $table->string('employment_type', 50);
            $table->string('education', 50);
            $table->string('experience', 50);
            $table->text('job_application');
            $table->string('status', 20);
            $table->timestamp('publish_at')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->string('salary_type', 50);
            $table->string('salary_currency', 50)->nullable();
            $table->integer('salary_from')->nullable();
            $table->integer('salary_to')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'department_id', 'slug']);
            $table->foreign('user_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'departments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(env('DB_TABLES_PREFIX', '') . 'jobs');
    }
}
