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
     * Update General Settings Action
     *
     * @return string
     */
	public function updateGeneralSettingsAction()
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

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.update_general_settings_success_message')]] : ["form" => [trans('messages.update_general_settings_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Update Advanced Settings Action
     *
     * @return string
     */
	public function updateAdvancedSettingsAction()
	{
        //~
	}

    /**
     * Update Routes Action
     *
     * @return string
     */
	public function updateRoutesAction()
	{
        $result = $this->route->syncRoute();

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.update_routes_success_message')]] : ["form" => [trans('messages.update_routes_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Delete Route Action
     *
     * @return string
     */
    public function deleteRouteAction()
    {
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer'
        ], [
            'id.required' => trans('messages.delete_route_error_id_required'),
            'id.integer' => trans('messages.delete_route_error_id_integer'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->route->deleteRoute([
            'id' => $this->request->input('id')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.delete_route_success_message')]] : ["form" => [trans('messages.delete_route_error_message')]],
            'data' => [],
        ]);
    }

    /**
     * Update Route Permission Action
     *
     * @return string
     */
	public function updateRoutePermissionAction()
	{
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer',
            'permission_id' => 'required',
            'enabled' => 'required',
        ], [
            'id.required' => trans('messages.update_route_permission_error_id_required'),
            'id.integer' => trans('messages.update_route_permission_error_id_integer'),
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
            'id' => $this->request->input('id')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.update_route_permission_success_message')]] : ["form" => [trans('messages.update_route_permission_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Add Role Action
     *
     * @return string
     */
	public function addRoleAction()
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
            return response()->json([
                'status' => 'error',
                'messages' => ["form" => [trans('messages.add_role_error_name_unique')]],
                'data' => [],
            ]);
        }

        $result = $this->role->addRole([
            'name' => $this->request->input('name'),
            'display_name' => $this->request->input('display_name'),
            'description' => empty($this->request->input('description')) ? '' : $this->request->input('description')
        ]);

        # Add Roles Permissions
        $this->role->addRolePermissions($this->request->input('name'), $this->request->input('permissions'));

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.add_role_success_message')]] : ["form" => [trans('messages.add_role_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Edit Role Action
     *
     * @return string
     */
	public function editRoleAction()
	{
        $validator = Validator::make($this->request->all(), [
            'id' => 'required',
            'name' => 'required',
            'display_name' => 'required'
        ], [
            'id.required' => trans('messages.edit_role_error_id_required'),
            'name.required' => trans('messages.edit_role_error_name_required'),
            'display_name.required' => trans('messages.edit_role_error_display_name_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->role->checkRole($this->request->input('name'), $this->request->input('id')) ){
            return response()->json([
                'status' => 'error',
                'messages' => ["form" => [trans('messages.edit_role_error_name_unique')]],
                'data' => [],
            ]);
        }

        $result = $this->role->editRole([
            'name' => $this->request->input('name'),
            'display_name' => $this->request->input('display_name'),
            'description' => empty($this->request->input('description')) ? '' : $this->request->input('description')
        ],[
            'id' => $this->request->input('id')
        ]);

        # Edit Role Permissions
        $this->role->updateRolePermissions($this->request->input('name'), $this->request->input('permissions'));

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.edit_role_success_message')]] : ["form" => [trans('messages.edit_role_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Delete Role Action
     *
     * @return string
     */
	public function deleteRoleAction()
	{
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer'
        ], [
            'id.required' => trans('messages.delete_role_error_id_required'),
            'id.integer' => trans('messages.delete_role_error_id_integer'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->role->deleteRole([
            'id' => $this->request->input('id')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.delete_role_success_message')]] : ["form" => [trans('messages.delete_role_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Add Permission Action
     *
     * @return string
     */
	public function addPermissionAction()
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
            return response()->json([
                'status' => 'error',
                'messages' => ["form" => [trans('messages.add_permission_error_name_unique')]],
                'data' => [],
            ]);
        }

        $result = $this->permission->addPermission([
            'name' => $this->request->input('name'),
            'display_name' => $this->request->input('display_name'),
            'description' => empty($this->request->input('description')) ? '' : $this->request->input('description')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.add_permission_success_message')]] : ["form" => [trans('messages.add_permission_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Edit Permission Action
     *
     * @return string
     */
	public function editPermissionAction()
	{
        $validator = Validator::make($this->request->all(), [
            'id' => 'required',
            'name' => 'required',
            'display_name' => 'required'
        ], [
            'id.required' => trans('messages.edit_permission_error_id_required'),
            'name.required' => trans('messages.edit_permission_error_name_required'),
            'display_name.required' => trans('messages.edit_permission_error_display_name_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        if( $this->permission->checkPermission($this->request->input('name'), $this->request->input('id')) ){
            return response()->json([
                'status' => 'error',
                'messages' => ["form" => [trans('messages.edit_permission_error_name_unique')]],
                'data' => [],
            ]);
        }

        $result = $this->permission->editPermission([
            'name' => $this->request->input('name'),
            'display_name' => $this->request->input('display_name'),
            'description' => empty($this->request->input('description')) ? '' : $this->request->input('description')
        ],[
            'id' => $this->request->input('id')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.edit_permission_success_message')]] : ["form" => [trans('messages.edit_permission_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Delete Permission Action
     *
     * @return string
     */
	public function deletePermissionAction()
	{
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer'
        ], [
            'id.required' => trans('messages.delete_permission_error_id_required'),
            'id.integer' => trans('messages.delete_permission_error_id_integer'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->permission->deletePermission([
            'id' => $this->request->input('id')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.delete_permission_success_message')]] : ["form" => [trans('messages.delete_permission_error_message')]],
            'data' => [],
        ]);
	}
}