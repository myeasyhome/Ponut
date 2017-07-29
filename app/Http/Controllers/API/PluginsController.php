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

class PluginsController extends Controller
{

    /**
     * Activate Plugin Action
     *
     * @return string
     */
	public function activatePlugin()
	{
        $validator = Validator::make($this->request->all(), [
            'plugin' => 'required'
        ], [
            'plugin.required' => trans('messages.activate_plugin_error_plugin_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->plugin->activatePlugin($this->request->input('plugin'));

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.activate_plugin_success_message')]] : ["form" => [trans('messages.activate_plugin_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Deactivate Plugin Action
     *
     * @return string
     */
	public function deactivatePlugin()
	{
        $validator = Validator::make($this->request->all(), [
            'plugin' => 'required'
        ], [
            'plugin.required' => trans('messages.deactivate_plugin_error_plugin_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->plugin->deactivatePlugin($this->request->input('plugin'));

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.deactivate_plugin_success_message')]] : ["form" => [trans('messages.deactivate_plugin_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Delete Plugin Action
     *
     * @return string
     */
	public function deletePlugin()
	{
        $validator = Validator::make($this->request->all(), [
            'plugin' => 'required'
        ], [
            'plugin.required' => trans('messages.delete_plugin_error_plugin_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->plugin->deletePlugin($this->request->input('plugin'));

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.delete_plugin_success_message')]] : ["form" => [trans('messages.delete_plugin_error_message')]],
            'data' => [],
        ]);
    }
}