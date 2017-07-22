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

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(env('DB_TABLES_PREFIX', '') . 'candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->integer('phase_id')->unsigned()->nullable();
            $table->string('status', 20);
            $table->string('name', 200);
            $table->string('email', 200);
            $table->string('headline', 200);
            $table->string('phone', 200);
            $table->string('address', 250);
            $table->integer('photo_file_id')->unsigned();
            $table->text('summary');
            $table->text('education');
            $table->text('experience');
            $table->integer('resume_file_id')->unsigned();
            $table->integer('cover_letter_file_id')->unsigned();
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'jobs')->onDelete('cascade');
            $table->foreign('phase_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'job_phases')->onDelete('cascade');
            $table->foreign('photo_file_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'files')->onDelete('cascade');
            $table->foreign('resume_file_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'files')->onDelete('cascade');
            $table->foreign('cover_letter_file_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(env('DB_TABLES_PREFIX', '') . 'candidates');
    }
}
