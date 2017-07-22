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

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    public $timestamps = false;

    public function __construct()
    {
        $this->table = env('DB_TABLES_PREFIX', '') . $this->table;
    }

    public function permission()
    {
        return $this->belongsTo('Ponut\Models\Permission', 'permission_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo('Ponut\Models\Role', 'role_id', 'id');
    }
}
