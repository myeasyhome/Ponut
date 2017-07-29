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
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->department->slugExist($this->request->input('slug')) ){
            return response()->json([
                'status' => 'error',
                'messages' => ["form" => [trans('messages.add_department_error_slug_exist')]],
                'data' => [],
            ]);
        }

        $result = $this->department->insertDepartment([
            'name' => $this->request->input('name'),
            'slug' => $this->request->input('slug')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.add_department_success_message')]] : ["form" => [trans('messages.add_department_error_message')]],
            'data' => [],
        ]);
    }

    /**
     * Edit Department
     *
     * @return string
     */
    public function editDepartment()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required',
            'name' => 'required',
            'slug' => 'required'
        ], [
            'id.required' => trans('messages.edit_department_error_id_required'),
            'name.required' => trans('messages.edit_department_error_name_required'),
            'slug.required' => trans('messages.edit_department_error_slug_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->department->slugExist($this->request->input('slug'), $this->request->input('id')) ){
            return response()->json([
                'status' => 'error',
                'messages' => ["form" => [trans('messages.edit_department_error_slug_exist')]],
                'data' => [],
            ]);
        }

        $result = $this->department->updateDepartment([
            'id' => $this->request->input('id')
        ],[
            'name' => $this->request->input('name'),
            'slug' => $this->request->input('slug')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.edit_department_success_message')]] : ["form" => [trans('messages.edit_department_error_message')]],
            'data' => [],
        ]);
    }

    /**
     * Delete Department
     *
     * @return string
     */
    public function deleteDepartment()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required'
        ], [
            'id.required' => trans('messages.delete_department_error_invalid_id')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->department->deleteDepartment([
            'id' => $this->request->input('id')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.delete_department_success_message')]] : ["form" => [trans('messages.delete_department_error_message')]],
            'data' => [],
        ]);
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
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        return response()->json([
            'status' => 'success',
            'messages' => ["form" => [trans('messages.build_department_slug_success_message')]],
            'data' => [
                'slug' => $this->department->buildSlug($this->request->input('name'))
            ],
        ]);
    }
}