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

class Candidate extends Model
{
    protected $table = 'candidates';
    public $timestamps = true;

    public function __construct()
    {
        $this->table = env('DB_TABLES_PREFIX', '') . $this->table;
    }

    public function metas()
    {
        return $this->hasMany('Ponut\Models\CandidateMeta', 'candidate_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo('Ponut\Models\Job', 'candidate_id', 'id');
    }

     public function field_value()
    {
        return $this->hasMany('Ponut\Models\FieldValue', 'candidate_id', 'id');
    }
}