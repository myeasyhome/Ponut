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

class Field extends Model
{
    protected $table = 'fields';
    public $timestamps = true;

    public function job()
    {
        return $this->belongsTo('Ponut\Models\Job', 'job_id', 'id');
    }

    public function field_values()
    {
        return $this->hasMany('Ponut\Models\FieldValue', 'field_id', 'id');
    }
}