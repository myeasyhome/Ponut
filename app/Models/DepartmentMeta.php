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

class DepartmentMeta extends Model
{
    protected $table = 'departments_meta';
    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('Ponut\Models\Department', 'department_id', 'id');
    }
}