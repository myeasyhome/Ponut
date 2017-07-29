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

class AppearanceController extends Controller
{

    /**
     * Activate Theme Action
     *
     * @return string
     */
	public function activateTheme()
	{
        $validator = Validator::make($this->request->all(), [
            'theme' => 'required'
        ], [
            'theme.required' => trans('messages.activate_theme_error_theme_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->appearance->activateTheme($this->request->input('theme'));

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.activate_theme_success_message')]] : ["form" => [trans('messages.activate_theme_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Delete Theme Action
     *
     * @return string
     */
	public function deleteTheme()
	{
        $validator = Validator::make($this->request->all(), [
            'theme' => 'required'
        ], [
            'theme.required' => trans('messages.delete_theme_error_theme_required')
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->appearance->deleteTheme($this->request->input('theme'));

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.delete_theme_success_message')]] : ["form" => [trans('messages.delete_theme_error_message')]],
            'data' => [],
        ]);
	}

    /**
     * Customize Theme Action
     *
     * @return string
     */
	public function customizeTheme()
	{
        $validator = Validator::make($this->request->all(), [
            'font' => 'required',
            'skin' => 'required'
        ], [
            'font.required' => trans('messages.customize_theme_error_font_required'),
            'skin.required' => trans('messages.customize_theme_error_skin_required'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->appearance->customize([
        	'font' => $this->request->input('font'),
        	'skin' => $this->request->input('skin')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.customize_theme_success_message')]] : ["form" => [trans('messages.customize_theme_error_message')]],
            'data' => [],
        ]);
	}
}