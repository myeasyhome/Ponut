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

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Notifiable;

    protected $table = 'users';
    public $timestamps = true;
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function metas()
    {
        return $this->hasMany('Ponut\Models\UserMeta', 'user_id', 'id');
    }
}
