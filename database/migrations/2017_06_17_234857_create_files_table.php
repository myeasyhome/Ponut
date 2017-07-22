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

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(env('DB_TABLES_PREFIX', '') . 'files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('storage_type', 50);
            $table->string('rel_path', 200);
            $table->integer('user_id')->unsigned();
            $table->integer('year');
            $table->integer('month');
            $table->string('new_name', 200);
            $table->string('old_name', 200);
            $table->string('extension', 50);
            $table->string('file_type', 50);
            $table->string('size', 50);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on(env('DB_TABLES_PREFIX', '') . 'users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(env('DB_TABLES_PREFIX', '') . 'files');
    }
}
