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

class CreateJobPhaseScorecardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_phase_scorecard', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phase_id')->unsigned();
            $table->string('criteria', 100);
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
        Schema::dropIfExists('job_phase_scorecard');
    }
}
