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

class LoginController extends Controller
{

    /**
     * Auth User
     *
     * @return string
     */
    public function auth()
    {
        $validator = Validator::make($this->request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => trans('messages.login_error_username_required'),
            'password.required' => trans('messages.login_error_password_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors()->toArray(), "validation");
            return response()->json($this->getResponse());
        }

        if( strpos($this->request->input('username'), '@') ){
            $result = (boolean) Auth::attempt(['email' => $this->request->input('username'), 'password' => $this->request->input('password'), 'status' => 'active'], $this->request->input('remember'));
        }else{
            $result = (boolean) Auth::attempt(['username' => $this->request->input('username'), 'password' => $this->request->input('password'), 'status' => 'active'], $this->request->input('remember'));
        }


        $this->updateResponseStatus($result);

        // set api access token & refresh token in case user already exist
        if( $result ){
            $user_api_data = $this->user->getApiData($this->request->input('username'));
            $this->updateResponsePayload([
                # 'api_refresh_token' => $this->option->getOption('_api_refresh_token'),
                'api_token' => $user_api_data['api_token'],
                'api_token_expire' => $user_api_data['api_token_expire']
            ]);

            $this->updateResponseMessage([
                "code" => 'success',
                "messages" => [
                    [
                        "type" => 'success',
                        "message" => trans('messages.login_success_message')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $this->updateResponseMessage([
            "code" => 'invalid_login',
            "messages" => [
                [
                    "type" => 'error',
                    "message" => trans('messages.login_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Get Refresh token
     *
     * @return string
     */
    public function fetchRefreshToken()
    {
        // refresh api refresh token if required
        $this->option->updateApiRefreshToken();

        $this->updateResponseStatus(true);
        $this->updateResponsePayload([
            'api_refresh_token' => $this->option->getOption('_api_refresh_token'),
        ]);
        $this->updateResponseMessage([
            "code" => 'success',
            "messages" => [
                [
                    "type" => 'success',
                    "message" => trans('messages.refresh_token_success_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Update Access tocken
     *
     *  @return string
     */
    public function updateAccessToken()
    {
        // Validate API refresh Token
        $validator = Validator::make($this->request->all(), [
            'api_refresh_token' => 'required'
        ], [
            'api_refresh_token.required' => trans('messages.update_access_token_empty_refresh_token_error_message')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => 'invalid_refresh_token',
                "messages" => [
                    [
                        "type" => 'error',
                        "message" =>  trans('messages.update_access_token_invalid_refresh_token_error_message')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        if( ($this->request->input('api_refresh_token') != $this->option->getOption('_api_refresh_token')) && ($this->request->input('api_refresh_token') != $this->option->getOption('_api_old_refresh_token')) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => 'invalid_refresh_token',
                "messages" => [
                    [
                        "type" => 'error',
                        "message" =>  trans('messages.update_access_token_invalid_refresh_token_error_message')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = $this->user->refreshAccessToken($this->request->user()->id);

        if( empty($result) ){

            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => 'unknown_error',
                "messages" => [
                    [
                        "type" => 'error',
                        "message" =>  trans('messages.update_access_token_unknown_error_message')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());

        }else{

            $this->updateResponseStatus(true);
            $this->updateResponsePayload([
                'api_token' => $result['api_token'],
                'api_token_expire' => $result['api_token_expire']
            ]);
            $this->updateResponseMessage([
                "code" => 'success',
                "messages" => [
                    [
                        "type" => 'success',
                        "message" => trans('messages.update_access_token_success_message')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());

        }
    }
}