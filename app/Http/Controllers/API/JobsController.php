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

class JobsController extends Controller
{

    /**
     * Add Job
     *
     * @return string
     */
	public function addJob()
	{
        $validator = Validator::make($this->request->all(), [
            'department_id' => 'required|integer',
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'status' => 'required',
            'expired_at' => 'required',
            'published_at' => 'required',
        ], [
            'department_id.required' => trans('messages.add_job_error_username_required'),
            'title.required' => trans('messages.add_job_error_status_required'),
            'slug.required' => trans('messages.add_job_error_status_required'),
            'description.required' => trans('messages.add_job_error_status_required'),
            'status.required' => trans('messages.add_job_error_status_required'),
            'expired_at.required' => trans('messages.add_job_error_status_required'),
            'published_at.required' => trans('messages.add_job_error_status_required'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->job->insertJob([
            'user_id' => $this->auth_user->id,
            'department_id' => $this->request->input('department_id'),
            'title' => $this->request->input('title'),
            'slug' => $this->request->input('slug'),
            'description' => $this->request->input('description'),
            'status' => $this->request->input('status'),
            'expired_at' => $this->request->input('expired_at'),
            'published_at' => $this->request->input('published_at'),
        ]);

        # Add Job Fields


        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.add_job_success_message') : trans('messages.add_job_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());

	}

    /**
     * Edit Job
     *
     * @return string
     */
	public function editJob()
	{
        //~
	}

    /**
     * Delete Job
     *
     * @return string
     */
	public function deleteJob()
	{
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer'
        ], [
            'id.required' => trans('messages.delete_job_error_id_required'),
            'id.integer' => trans('messages.delete_job_error_id_integer'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->job->deleteJob([
            'id' => $this->request->input('id')
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.delete_job_success_message') : trans('messages.delete_job_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
	}
}
