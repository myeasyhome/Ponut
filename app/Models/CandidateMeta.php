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

class CandidateMeta extends Model
{
    protected $table = 'candidates_meta';
    public $timestamps = false;

    public function __construct()
    {
        $this->table = env('DB_TABLES_PREFIX', '') . $this->table;
    }

    public function candidate()
    {
        return $this->belongsTo('Ponut\Models\Candidate', 'candidate_id', 'id');
    }
}
