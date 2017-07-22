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

class Job extends Model
{
    protected $table = 'jobs';
    public $timestamps = true;

    public function __construct()
    {
        $this->table = env('DB_TABLES_PREFIX', '') . $this->table;
    }

    public function metas()
    {
        return $this->hasMany('Ponut\Models\JobMeta', 'job_id', 'id');
    }

    public function candidates()
    {
        return $this->hasMany('Ponut\Models\Candidate', 'job_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('Ponut\Models\Department', 'department_id', 'id');
    }

    public function fields()
    {
        return $this->hasMany('Ponut\Models\Field', 'job_id', 'id');
    }
}
