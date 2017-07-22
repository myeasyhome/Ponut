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

class JobMeta extends Model
{
    protected $table = 'jobs_meta';
    public $timestamps = false;

    public function job()
    {
        return $this->belongsTo('Ponut\Models\Job', 'job_id', 'id');
    }
}