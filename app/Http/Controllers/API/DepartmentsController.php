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

class DepartmentsController extends Controller
{

    /**
     * Add Department
     *
     * @return string
     */
    public function addDepartment()
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ], [
            'name.required' => trans('messages.add_department_error_name_required'),
            'slug.required' => trans('messages.add_department_error_slug_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors()->toArray(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->department->slugExist($this->request->input('slug')) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "slug",
                        "message" => trans('messages.add_department_error_slug_exist')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = $this->department->insertDepartment([
            'name' => $this->request->input('name'),
            'slug' => $this->request->input('slug')
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.add_department_success_message') : trans('messages.add_department_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Edit Department
     *
     * @param integer $id
     * @return string
     */
    public function editDepartment($id)
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ], [
            'name.required' => trans('messages.edit_department_error_name_required'),
            'slug.required' => trans('messages.edit_department_error_slug_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors()->toArray(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->department->slugExist($this->request->input('slug'), $id) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "slug",
                        "message" => trans('messages.edit_department_error_slug_exist')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = $this->department->updateDepartment([
            'id' => $id
        ],[
            'name' => $this->request->input('name'),
            'slug' => $this->request->input('slug')
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.edit_department_success_message') : trans('messages.edit_department_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Delete Department
     *
     * @param integer $id
     * @return string
     */
    public function deleteDepartment($id)
    {
        $result = $this->department->deleteDepartment([
            'id' => $id
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.delete_department_success_message') : trans('messages.delete_department_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Build Department Slug Action
     *
     * @return string
     */
    public function buildDepartmentSlug()
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'required'
        ], [
            'name.required' => trans('messages.build_department_slug_error_name_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors()->toArray(), "validation");
            return response()->json($this->getResponse());
        }


        $this->updateResponseStatus(true);
        $this->updateResponseMessage([
            "code" => "success"
        ], "plain");
        $this->updateResponsePayload([
            'slug' => $this->department->buildSlug($this->request->input('name'))
        ], false);

        return response()->json($this->getResponse());
    }
}