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
     * Activate Plugin
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

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.activate_plugin_success_message') : trans('messages.activate_plugin_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
	}

    /**
     * Deactivate Plugin
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

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.deactivate_plugin_success_message') : trans('messages.deactivate_plugin_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
	}

    /**
     * Delete Plugin
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

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.delete_plugin_success_message') : trans('messages.delete_plugin_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }
}