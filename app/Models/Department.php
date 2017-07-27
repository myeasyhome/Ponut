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

class Department extends Model
{
    protected $table = 'departments';
    public $timestamps = true;

    public function metas()
    {
        return $this->hasMany('Ponut\Models\DepartmentMeta', 'department_id', 'id');
    }

    public function jobs()
    {
        return $this->hasMany('Ponut\Models\Job', 'department_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('Ponut\Models\User', 'user_id', 'id');
    }
}