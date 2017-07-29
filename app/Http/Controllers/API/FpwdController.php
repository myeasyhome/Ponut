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
    public function tokenAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|username_or_email',
        ], [
            'username.required' => trans('messages.forgot_password_form_username_required'),
            'username.username_or_email' => trans('messages.forgot_password_form_username_username_or_email_invalid'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $username = $request->input('username');
        $result = false;

        if( strpos($username, '@') ){
            if( $this->user->checkEmail($username) ){
                $result = $this->user->resetRequestWithEmail($username);
            }else{
                return response()->json([
                    'status' => 'error',
                    'messages' => ["username" => [trans('messages.forgot_password_form_username_username_or_email_invalid')]],
                    'data' => [],
                ]);
            }
        }else{
            if( $this->user->checkUsername($username) ){
                $result = $this->user->resetRequestWithUsername($username);
            }else{
                return response()->json([
                    'status' => 'error',
                    'messages' => ["username" => [trans('messages.forgot_password_form_username_username_or_email_invalid')]],
                    'data' => [],
                ]);
            }
        }

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.forgot_password_reset_email_sent')]] : ["form" => [trans('messages.database_error_form')]],
            'data' => [],
        ]);
    }

    /**
     * Reset User Password
     *
     * @return string
     */
    public function resetAction(Request $request)
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
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $reset_hash = $request->input('reset_hash');
        $new_password = $request->input('password');
        $result = false;

        if( !$this->user->isHashValid($reset_hash) ){
            return response()->json([
                'status' => 'error',
                'messages' => ["reset_hash" => [trans('messages.reset_password_form_token_expired_message')]],
                'data' => [],
            ]);
        }

        $result = $this->user->setNewPassword($reset_hash, $new_password);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.reset_password_pasword_changed')]] : ["form" => [trans('messages.database_error_form')]],
            'data' => [],
        ]);
    }
}