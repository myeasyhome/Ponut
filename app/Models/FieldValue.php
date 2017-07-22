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

class FieldValue extends Model
{
    protected $table = 'field_value';
    public $timestamps = true;

    public function candidate()
    {
        return $this->belongsTo('Ponut\Models\Candidate', 'candidate_id', 'id');
    }

    public function field()
    {
        return $this->belongsTo('Ponut\Models\Field', 'field_id', 'id');
    }
}