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

class UsersController extends Controller
{

    /**
     * Add User
     *
     * @return string
     */
	public function addUser()
	{
        $validator = Validator::make($this->request->all(), [
            'username' => 'required|username|unique:users,username',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'language' => 'required',
            'job_title' => 'required',
            'password' => 'required|password',
            'status' => 'required',
        ], [
            'username.required' => trans('messages.add_user_error_username_required'),
            'username.username' => trans('messages.add_user_error_username_username'),
            'username.unique' => trans('messages.add_user_error_username_unique'),
            'first_name.required' => trans('messages.add_user_error_first_name_required'),
            'last_name.required' => trans('messages.add_user_error_last_name_required'),
            'email.required' => trans('messages.add_user_error_email_required'),
            'email.email' => trans('messages.add_user_error_email_email'),
            'email.unique' => trans('messages.add_user_error_email_unique'),
            'language.required' => trans('messages.add_user_error_language_required'),
            'job_title.required' => trans('messages.add_user_error_job_title_required'),
            'password.required' => trans('messages.add_user_error_password_required'),
            'password.password' => trans('messages.add_user_error_password_password'),
            'status.required' => trans('messages.add_user_error_status_required'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->user->insertUser([
            'username' => $this->request->input('username'),
            'first_name' => $this->request->input('first_name'),
            'last_name' => $this->request->input('last_name'),
            'email' => $this->request->input('email'),
            'language' => $this->request->input('language'),
            'job_title' => $this->request->input('job_title'),
            'password' => \Hash::make($this->request->input('password')),
            'status' => $this->request->input('status')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.add_user_success_message')]] : ["form" => [trans('messages.add_user_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Edit User
     *
     * @return string
     */
	public function editUser()
	{
        $inputs = [
            'id' => 'required|integer',
            'username' => 'required|username',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'language' => 'required',
            'job_title' => 'required',
            'status' => 'required',
        ];
        $messages = [
            'id.required' => trans('messages.edit_user_error_id_required'),
            'id.integer' => trans('messages.edit_user_error_id_integer'),
            'username.required' => trans('messages.edit_user_error_username_required'),
            'username.username' => trans('messages.edit_user_error_username_username'),
            'first_name.required' => trans('messages.edit_user_error_first_name_required'),
            'last_name.required' => trans('messages.edit_user_error_last_name_required'),
            'email.required' => trans('messages.edit_user_error_email_required'),
            'email.email' => trans('messages.edit_user_error_email_email'),
            'language.required' => trans('messages.edit_user_error_language_required'),
            'job_title.required' => trans('messages.edit_user_error_job_title_required'),
            'status.required' => trans('messages.edit_user_error_status_required'),
        ];

        if( $this->request->has('change_password') ){
            $inputs['password'] = 'required|password';
            $messages['password.required'] = trans('messages.edit_user_error_password_required');
            $messages['password.password'] = trans('messages.edit_user_error_password_password');
        }

        $validator = Validator::make($this->request->all(), $inputs, $messages);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->user->checkUsername($this->request->input('username'), $this->request->input('id')) ){
            return response()->json([
                'status' => 'error',
                'messages' => ["form" => [trans('messages.edit_user_error_username_unique')]],
                'data' => [],
            ]);
        }


        if( $this->user->checkEmail($this->request->input('email'), $this->request->input('id')) ){
            return response()->json([
                'status' => 'error',
                'messages' => ["form" => [trans('messages.edit_user_error_email_unique')]],
                'data' => [],
            ]);
        }

        if( $this->request->has('change_password') ){

            $result = $this->user->updateUser([
                'id' => $this->request->input('id')
            ],[
                'username' => $this->request->input('username'),
                'first_name' => $this->request->input('first_name'),
                'last_name' => $this->request->input('last_name'),
                'email' => $this->request->input('email'),
                'language' => $this->request->input('language'),
                'job_title' => $this->request->input('job_title'),
                'password' => \Hash::make($this->request->input('password')),
                'status' => $this->request->input('status')
            ]);

        }else{

            $result = $this->user->updateUser([
                'id' => $this->request->input('id')
            ],[
                'username' => $this->request->input('username'),
                'first_name' => $this->request->input('first_name'),
                'last_name' => $this->request->input('last_name'),
                'email' => $this->request->input('email'),
                'language' => $this->request->input('language'),
                'job_title' => $this->request->input('job_title'),
                'status' => $this->request->input('status')
            ]);

        }

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.edit_user_success_message')]] : ["form" => [trans('messages.edit_user_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Delete User
     *
     * @return string
     */
	public function deleteUser()
	{
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer'
        ], [
            'id.required' => trans('messages.delete_user_error_id_required'),
            'id.integer' => trans('messages.delete_user_error_id_integer'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->user->deleteUser([
            'id' => $this->request->input('id')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.delete_user_success_message')]] : ["form" => [trans('messages.delete_user_error_message')]],
            'data' => [],
        ]);
	}
}