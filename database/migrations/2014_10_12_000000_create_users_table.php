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

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 60)->unique();
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('email', 60)->unique();
            $table->string('language', 20);
            $table->string('job_title');
            $table->string('password');
            $table->string('status', 20);
            $table->integer('avatar_file_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->index(['username', 'email']);
            $table->foreign('avatar_file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
