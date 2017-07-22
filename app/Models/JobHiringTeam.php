<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Models;

use Illuminate\Database\Eloquent\Model;

class JobHiringTeam extends Model
{
    protected $table = 'job_hiring_team';
    public $timestamps = false;

    public function __construct()
    {
        $this->table = env('DB_TABLES_PREFIX', '') . $this->table;
    }
}


