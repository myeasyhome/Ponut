<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Http\Controllers\API;

use Ponut\Http\Controllers\Controller;

use Validator;
use Input;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NotificationController extends Controller
{

    /**
     * Notify User
     *
     * @return string
     */
	public function notify()
	{

		$message = $this->notify->getNotifications($this->auth_user->id);

		#~ Send Notifications
	}
}
