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
use Ponut\Models\Option;
use Validator;
use Input;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
	public function test()
	{
		$this->updateResponseStatus(true);
		$this->updateResponsePayload(["id" => 1, "type" => "Article"], false);
		$this->updateResponsePayload(["Content" => "A7A"], false);
		#$this->updateResponsePayload(["id" => 1, "type" => "Article"], true);
		#$this->updateResponsePayload(["id" => 1, "type" => "Article"], true);

		$this->updateResponseMessage([
    		"code" => 1024,
    		"message" => "Validation Failed",
    		"errors" => [
    			[
    				"code" => 5432,
    				"field" => "first_name",
    				"message" => "First name cannot have fancy characters"
    			],
    			[
    				"code" => 5431,
    				"message" => ""
    			]
    		]
    	]);

		return response()->json($this->getResponse());
	}
}