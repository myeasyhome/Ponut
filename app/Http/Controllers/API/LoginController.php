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
    public function authAction()
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
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( strpos($this->request->input('username'), '@') ){
            $result = (boolean) Auth::attempt(['email' => $this->request->input('username'), 'password' => $this->request->input('password'), 'status' => 'active'], $this->request->input('remember'));
        }else{
            $result = (boolean) Auth::attempt(['username' => $this->request->input('username'), 'password' => $this->request->input('password'), 'status' => 'active'], $this->request->input('remember'));
        }

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.login_success_message')]] : ["form" => [trans('messages.login_error_message')]],
            'data' => [],
        ]);

    }
}