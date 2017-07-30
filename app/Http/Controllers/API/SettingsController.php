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

class SettingsController extends Controller
{

    /**
     * Update General Settings
     *
     * @return string
     */
    public function updateGeneralSettings()
    {
        $validator = Validator::make($this->request->all(), [
            '_site_title' => 'required',
            '_site_email' => 'required',
            '_site_emails_sender' => 'required',
            '_site_url' => 'required',
            #'_site_keywords' => 'required',
            #'_site_description' => 'required',
            '_site_lang' => 'required',
            '_site_timezone' => 'required',
            '_site_maintainance_mode' => 'required',
            #'_site_custom_styles' => 'required',
            #'_site_custom_scripts' => 'required',
            #'_site_tracking_codes' => 'required',
        ], [
            '_site_title.required' => trans('messages.update_general_settings_error_site_title_required'),
            '_site_email.required' => trans('messages.update_general_settings_error_site_email_required'),
            '_site_emails_sender.required' => trans('messages.update_general_settings_error_site_emails_sender_required'),
            '_site_url.required' => trans('messages.update_general_settings_error_site_url_required'),
            '_site_lang.required' => trans('messages.update_general_settings_error_site_lang_required'),
            '_site_timezone.required' => trans('messages.update_general_settings_error_site_timezone_required'),
            '_site_maintainance_mode.required' => trans('messages.update_general_settings_error_site_maintainance_mode_required'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->option->updateOptions([
            '_site_title' => $this->request->input('_site_title'),
            '_site_email' => $this->request->input('_site_email'),
            '_site_emails_sender' => $this->request->input('_site_emails_sender'),
            '_site_url' => $this->request->input('_site_url'),
            '_site_keywords' => (empty($this->request->input('_site_keywords'))) ? '' : $this->request->input('_site_keywords'),
            '_site_description' => (empty($this->request->input('_site_description'))) ? '' : $this->request->input('_site_description'),
            '_site_lang' => $this->request->input('_site_lang'),
            '_site_timezone' => $this->request->input('_site_timezone'),
            '_site_maintainance_mode' => $this->request->input('_site_maintainance_mode'),
            '_site_custom_styles' => (empty($this->request->input('_site_custom_styles'))) ? '' : $this->request->input('_site_custom_styles'),
            '_site_custom_scripts' => (empty($this->request->input('_site_custom_scripts'))) ? '' : $this->request->input('_site_custom_scripts'),
            '_site_tracking_codes' => (empty($this->request->input('_site_tracking_codes'))) ? '' : $this->request->input('_site_tracking_codes'),
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.update_general_settings_success_message') : trans('messages.update_general_settings_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Update Advanced Settings
     *
     * @return string
     */
    public function updateAdvancedSettings()
    {
        //~
    }

    /**
     * Update Routes
     *
     * @return string
     */
    public function updateRoutes()
    {
        $result = $this->route->syncRoute();

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.update_routes_success_message') : trans('messages.update_routes_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Delete Route
     *
     * @param integer $id
     * @return string
     */
    public function deleteRoute($id)
    {
        $result = $this->route->deleteRoute([
            'id' => $id
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.delete_route_success_message') : trans('messages.delete_route_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Update Route Permission
     *
     * @param integer $id
     * @return string
     */
    public function updateRoutePermission($id)
    {
        $validator = Validator::make($this->request->all(), [
            'permission_id' => 'required',
            'enabled' => 'required',
        ], [
            'permission_id.required' => trans('messages.update_route_permission_error_permission_id_required'),
            'enabled.required' => trans('messages.update_route_permission_error_enabled_required'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->route->editRoute([
            'permission_id' => (empty($this->request->input('permission_id'))) ? '0' : $this->request->input('permission_id'),
            'enabled' => $this->request->input('enabled')
        ],[
            'id' => $id
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.update_route_permission_success_message') : trans('messages.update_route_permission_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Add Role
     *
     * @return string
     */
    public function addRole()
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'required',
            'display_name' => 'required'
        ], [
            'name.required' => trans('messages.add_role_error_name_required'),
            'display_name.required' => trans('messages.add_role_error_display_name_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->role->checkRole($this->request->input('name')) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "name",
                        "message" => trans('messages.add_role_error_name_unique')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = $this->role->addRole([
            'name' => $this->request->input('name'),
            'display_name' => $this->request->input('display_name'),
            'description' => empty($this->request->input('description')) ? '' : $this->request->input('description')
        ]);

        # Add Roles Permissions
        $this->role->addRolePermissions($this->request->input('name'), $this->request->input('permissions'));

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.add_role_success_message') : trans('messages.add_role_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Edit Role
     *
     * @param integer $id
     * @return string
     */
    public function editRole($id)
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'required',
            'display_name' => 'required'
        ], [
            'name.required' => trans('messages.edit_role_error_name_required'),
            'display_name.required' => trans('messages.edit_role_error_display_name_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->role->checkRole($this->request->input('name'), $id) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "name",
                        "message" => trans('messages.edit_role_error_name_unique')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = $this->role->editRole([
            'name' => $this->request->input('name'),
            'display_name' => $this->request->input('display_name'),
            'description' => empty($this->request->input('description')) ? '' : $this->request->input('description')
        ],[
            'id' => $id
        ]);

        # Edit Role Permissions
        $this->role->updateRolePermissions($this->request->input('name'), $this->request->input('permissions'));

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.edit_role_success_message') : trans('messages.edit_role_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Delete Role
     *
     * @param integer $id
     * @return string
     */
    public function deleteRole($id)
    {

        $result = $this->role->deleteRole([
            'id' => $id
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.delete_role_success_message') : trans('messages.delete_role_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Add Permission
     *
     * @return string
     */
    public function addPermission()
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'required',
            'display_name' => 'required'
        ], [
            'name.required' => trans('messages.add_permission_error_name_required'),
            'display_name.required' => trans('messages.add_permission_error_display_name_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->permission->checkPermission($this->request->input('name')) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "name",
                        "message" => trans('messages.add_permission_error_name_unique')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = $this->permission->addPermission([
            'name' => $this->request->input('name'),
            'display_name' => $this->request->input('display_name'),
            'description' => empty($this->request->input('description')) ? '' : $this->request->input('description')
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.add_permission_success_message') : trans('messages.add_permission_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Edit Permission
     *
     * @param integer $id
     * @return string
     */
    public function editPermission($id)
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'required',
            'display_name' => 'required'
        ], [
            'name.required' => trans('messages.edit_permission_error_name_required'),
            'display_name.required' => trans('messages.edit_permission_error_display_name_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->permission->checkPermission($this->request->input('name'), $id) ){
            $this->updateResponseStatus(false);
            $this->updateResponseMessage([
                "code" => "validation_errors",
                "messages" => [
                    [
                        "type" => "error",
                        "field_id" => "name",
                        "message" => trans('messages.edit_permission_error_name_unique')
                    ]
                ]
            ], "plain");

            return response()->json($this->getResponse());
        }

        $result = $this->permission->editPermission([
            'name' => $this->request->input('name'),
            'display_name' => $this->request->input('display_name'),
            'description' => empty($this->request->input('description')) ? '' : $this->request->input('description')
        ],[
            'id' => $id
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.edit_permission_success_message') : trans('messages.edit_permission_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }

    /**
     * Delete Permission
     *
     * @param integer $id
     * @return string
     */
    public function deletePermission($id)
    {
        $result = $this->permission->deletePermission([
            'id' => $id
        ]);

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.delete_permission_success_message') : trans('messages.delete_permission_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }
}