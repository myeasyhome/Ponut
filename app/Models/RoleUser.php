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

class RoleUser extends Model
{
    protected $table = 'role_user';
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo('Ponut\Models\Role', 'role_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('Ponut\Models\User', 'user_id', 'id');
    }
}
