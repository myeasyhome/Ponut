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

class CreateJobPhaseQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_phase_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phase_id')->unsigned();
            $table->integer('order');
            $table->text('question');
            $table->text('answer');
            $table->enum('allow_rating', ['on', 'off']);
            $table->timestamps();
            $table->foreign('phase_id')->references('id')->on('job_phases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_phase_questions');
    }
}
