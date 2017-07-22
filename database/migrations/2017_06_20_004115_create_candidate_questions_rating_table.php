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

class CreateCandidateQuestionsRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(env('DB_TABLES_PREFIX', '') . 'candidate_questions_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('rating', 50);
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'candidates')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'job_phase_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(env('DB_TABLES_PREFIX', '') . 'candidate_questions_rating');
    }
}
