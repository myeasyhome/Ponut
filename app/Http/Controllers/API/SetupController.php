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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SetupController extends Controller
{

    public function siteOptions()
    {
        $validator = Validator::make($this->request->all(), [
            'site_title' => 'required|min:2|max:20',
            'site_email' => 'required|email|max:30',
            'site_url' => 'required|url|max:30'
        ], [
            'site_title.required' => trans('messages.setup_error_site_title_required'),
            'site_title.min' => trans('messages.setup_error_site_title_min'),
            'site_title.max' => trans('messages.setup_error_site_title_max'),

            'site_email.required' => trans('messages.setup_error_site_email_required'),
            'site_email.email' => trans('messages.setup_error_site_email_email'),
            'site_email.max' => trans('messages.setup_error_site_email_max'),

            'site_url.required' => trans('messages.setup_error_site_url_required'),
            'site_url.url' => trans('messages.setup_error_site_url_url'),
            'site_url.max' => trans('messages.setup_error_site_url_max'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
			$this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->setup->runSecondSetupStep($this->request->input('site_title'), $this->request->input('site_email'), $this->request->input('site_url'));

        $this->updateResponseStatus($result);
		$this->updateResponseMessage([
    		"code" => ($result) ? 'success' : 'db_error',
    		"messages" => [
    			[
    				"type" => ($result) ? 'success' : 'error',
    				"message" =>  ($result) ? trans('messages.setup_step_2_success') : trans('messages.database_error_form')
    			]
    		]
    	], "plain");

        return response()->json($this->getResponse());

    }

    public function siteAdmin()
    {
        $validator = Validator::make($this->request->all(), [
            'username' => 'required|username|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|password'
        ], [
            'username.required' => trans('messages.setup_error_username_required'),
            'username.username' => trans('messages.setup_error_username_username'),
            'username.unique' => trans('messages.setup_error_username_unique'),

            'email.required' => trans('messages.setup_error_email_required'),
            'email.email' => trans('messages.setup_error_email_email'),
            'email.unique' => trans('messages.setup_error_email_unique'),

            'password.required' => trans('messages.setup_error_password_required'),
            'password.password' => trans('messages.setup_error_password_password'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
			$this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->setup->runThirdSetupStep($this->request->input('username'), $this->request->input('email'), $this->request->input('password'));

        if( $result ){
            $this->notify->pushThankYouNotification($result);
        }


        $this->updateResponseStatus($result);
		$this->updateResponseMessage([
    		"code" => ($result) ? 'success' : 'db_error',
    		"messages" => [
    			[
    				"type" => ($result) ? 'success' : 'error',
    				"message" =>  ($result) ? trans('messages.setup_step_3_success') : trans('messages.database_error_form')
    			]
    		]
    	], "plain");

        return response()->json($this->getResponse());
    }

}