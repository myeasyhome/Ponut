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

class ProfileController extends Controller
{

    /**
     * Update Profile
     *
     * @return string
     */
	public function updateProfile()
	{
        $validator = Validator::make($this->request->all(), [
            'username' => 'required|username|max:30',
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email|max:30',
            'language' => 'required|max:30',
            'job_title' => 'required|max:50',
        ], [
            'username.required' => trans('messages.profile_update_error_username_required'),
            'username.username' => trans('messages.profile_update_error_username_username'),
            'username.max' => trans('messages.profile_update_error_username_max'),
            'first_name.required' => trans('messages.profile_update_error_first_name_required'),
            'first_name.max' => trans('messages.profile_update_error_first_name_max'),
            'last_name.required' => trans('messages.profile_update_error_last_name_required'),
            'last_name.max' => trans('messages.profile_update_error_last_name_max'),
            'email.required' => trans('messages.profile_update_error_email_required'),
            'email.email' => trans('messages.profile_update_error_email_email'),
            'email.max' => trans('messages.profile_update_error_email_max'),
            'language.required' => trans('messages.profile_update_error_language_required'),
            'language.max' => trans('messages.profile_update_error_language_max'),
            'job_title.required' => trans('messages.profile_update_error_job_title_required'),
            'job_title.max' => trans('messages.profile_update_error_job_title_max'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        // check if username is not valid
        if( $this->user->countUsersBy([['id', '!=', $this->auth_user->id], ['username', '=', $this->request->input('username')]]) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "username",
                        "message" => trans('messages.profile_update_error_username_notvalid')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        // check if email is not valid
        if( $this->user->countUsersBy([['id', '!=', $this->auth_user->id], ['email', '=', $this->request->input('email')]]) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "email",
                        "message" => trans('messages.profile_update_error_email_notvalid')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = (boolean) $this->user->updateUser([
        	'id' => $this->auth_user->id
        ], [
            'username' => $this->request->input('username'),
            'first_name' => $this->request->input('first_name'),
            'last_name' => $this->request->input('last_name'),
            'email' => $this->request->input('email'),
            'language' => $this->request->input('language'),
            'job_title' => $this->request->input('job_title'),
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.profile_update_success_message') : trans('messages.profile_update_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
	}

    /**
     * Update Password
     *
     * @return string
     */
	public function updatePassword()
	{
        $user_id = $this->auth_user->id;

        $validator = Validator::make($this->request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|password',
        ], [
            'old_password.required' => trans('messages.profile_update_error_old_password_required'),
            'new_password.required' => trans('messages.profile_update_error_new_password_required'),
            'new_password.password' => trans('messages.profile_update_error_new_password_password'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        // check if old password is valid
		if ( !$this->user->checkOldPassword($this->auth_user->id, $this->request->input('old_password')) ){

            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "old_password",
                        "message" => trans('messages.profile_update_error_old_password_notvalid')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
		}

        $result = (boolean) $this->user->updateUser([
        	'id' => $this->auth_user->id
        ], [
            'password' => \Hash::make($this->request->input('new_password')),
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.profile_password_update_success_message') : trans('messages.profile_password_update_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
	}
}