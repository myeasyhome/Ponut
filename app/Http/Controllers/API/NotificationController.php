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
     * Notify User Action
     *
     * @return string
     */
	public function notifyAction()
	{
		if( empty($this->auth_user) ){
	        return response()->json([
	            'status' => 'success',
	            'message' => '',
	            'data' => [],
	        ]);
		}

		$message = $this->notify->getNotifications($this->auth_user->id);

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => [],
        ]);

	}
}
