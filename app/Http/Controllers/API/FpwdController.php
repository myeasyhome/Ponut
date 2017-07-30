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


class FpwdController extends Controller
{

    /**
     * Add Reset Token to User
     *
     * @return string
     */
    public function generateToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|username_or_email',
        ], [
            'username.required' => trans('messages.forgot_password_form_username_required'),
            'username.username_or_email' => trans('messages.forgot_password_form_username_username_or_email_invalid'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors()->toArray(), "validation");
            return response()->json($this->getResponse());
        }

        $username = $request->input('username');
        $result = false;

        if( strpos($username, '@') ){
            if( $this->user->checkEmail($username) ){
                $result = $this->user->resetRequestWithEmail($username);
            }else{
                $this->updateResponseStatus(false);
                $this->updateResponseMessage([
                    "code" => "validation_errors",
                    "messages" => [
                        [
                            "type" => "error",
                            "field_id" => "username",
                            "message" => trans('messages.forgot_password_form_username_username_or_email_invalid')
                        ]
                    ]
                ], "plain");

                return response()->json($this->getResponse());
            }
        }else{
            if( $this->user->checkUsername($username) ){
                $result = $this->user->resetRequestWithUsername($username);
            }else{
                $this->updateResponseStatus(false);
                $this->updateResponseMessage([
                    "code" => "validation_errors",
                    "messages" => [
                        [
                            "type" => "error",
                            "field_id" => "username",
                            "message" => trans('messages.forgot_password_form_username_username_or_email_invalid')
                        ]
                    ]
                ], "plain");

                return response()->json($this->getResponse());
            }
        }

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.forgot_password_reset_email_sent') : trans('messages.database_error_form')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Reset User Password
     *
     * @return string
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|password',
            'reset_hash' => 'required|plain',
        ], [
            'password.required' => trans('messages.reset_password_form_new_password_required'),
            'password.password' => trans('messages.reset_password_form_new_password_invalid'),
            'reset_hash.required' => trans('messages.reset_password_form_token_expired_message'),
            'reset_hash.plain' => trans('messages.reset_password_form_token_expired_message'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors()->toArray(), "validation");
            return response()->json($this->getResponse());
        }

        $reset_hash = $request->input('reset_hash');
        $new_password = $request->input('password');
        $result = false;

        if( !$this->user->isHashValid($reset_hash) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "reset_hash",
                        "message" => trans('messages.reset_password_form_token_expired_message')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = $this->user->setNewPassword($reset_hash, $new_password);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.reset_password_pasword_changed') : trans('messages.database_error_form')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }
}