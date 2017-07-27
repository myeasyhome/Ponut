<?php

namespace Ponut\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $response = [
    	"success" => false,
    	"payload" => [],
    	"message" => []
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
    	#~
    }


    /**
     * Update API Response Status
     *
     * @param boolean $status
     * @return void
     */
    protected function updateResponseStatus($status)
    {
    	$this->response['success'] = $status;
    }

    /**
     * Update API Response Payload
     *
     * @param  array  $data
     * @param  boolean $as_array
     * @return void
     */
    protected function updateResponsePayload($data, $as_array = false)
    {
    	if( $as_array ){
    		$this->response['payload'][] = $data;
    	}else{
    		foreach ($data as $key => $value) {
    			$this->response['payload'][$key] = $value;
    		}
    	}
    }

    /**
     * Update Response Message
     *
     * @param array $message
     * @return void
     */
    protected function updateResponseMessage($message)
    {
    	$this->response["message"] = $message;
    }

    /**
     * Get Response
     *
     * @return arrau
     */
    protected function getResponse()
    {
    	return $this->response;
    }
}
