<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Auth;

use Ponut\Modules\Contracts\Entities\Candidate as CandidateContract;
use Ponut\Modules\Contracts\Entities\Department as DepartmentContract;
use Ponut\Modules\Contracts\Entities\Field as FieldContract;
use Ponut\Modules\Contracts\Entities\Job as JobContract;
use Ponut\Modules\Contracts\Entities\Option as OptionContract;
use Ponut\Modules\Contracts\Entities\Permission as PermissionContract;
use Ponut\Modules\Contracts\Entities\Role as RoleContract;
use Ponut\Modules\Contracts\Entities\Route as RouteContract;
use Ponut\Modules\Contracts\Entities\User as UserContract;

use Ponut\Modules\Contracts\API\Action\Analytics as AnalyticsContract;
use Ponut\Modules\Contracts\API\Action\Appearance as AppearanceContract;
use Ponut\Modules\Contracts\API\Action\Notify as NotifyContract;
use Ponut\Modules\Contracts\API\Action\Plugin as PluginContract;
use Ponut\Modules\Contracts\API\Action\Robot as RobotContract;
use Ponut\Modules\Contracts\API\Action\Setup as SetupContract;
use Ponut\Modules\Contracts\API\Action\Upgrade as UpgradeContract;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
        {
            "success": false,
            "payload": {
                "id": 3,
                "slug": "new-item"
            }
            "messages": [
                {
                    "type": "ValidationError",
                    "message": "bla bla ...!"
                },
                {
                    "type": "ValidationError",
                    "message": "bla bla ...!"
                }
            ]
        }
    */
    private $response = [
    	"success" => false,
    	"payload" => [],
    	"messages" => []
    ];

    protected $analytics;
    protected $candidate;
    protected $department;
    protected $field;
    protected $job;
    protected $option;
    protected $permission;
    protected $robot;
    protected $role;
    protected $setup;
    protected $upgrade;
    protected $user;
    protected $notify;
    protected $plugin;
    protected $appearance;
    protected $request;
    protected $auth_user;
    protected $route;


    /**
     * Constructor
     */
    public function __construct( AnalyticsContract $analytics, CandidateContract $candidate, DepartmentContract $department, FieldContract $field, JobContract $job, OptionContract $option, PermissionContract $permission, RobotContract $robot, RoleContract $role, SetupContract $setup, UpgradeContract $upgrade, UserContract $user, NotifyContract $notify, Request $request, PluginContract $plugin, AppearanceContract $appearance, RouteContract $route)
    {

        $this->analytics = $analytics;
        $this->candidate = $candidate;
        $this->department = $department;
        $this->field = $field;
        $this->job = $job;
        $this->option = $option;
        $this->permission = $permission;
        $this->robot = $robot;
        $this->role = $role;
        $this->setup = $setup;
        $this->upgrade = $upgrade;
        $this->user = $user;
        $this->notify = $notify;
        $this->plugin = $plugin;
        $this->appearance = $appearance;
        $this->request = $request;
        $this->route = $route;

        if( !$this->option->autoloadOptions('on') ){
            // DB May be Down or APP first Run
            $app_status = $this->setup->getAppStatus();

            if( "DB_CONNECTION_ERROR" == $app_status ){
                // Send to Server Error Page
            }elseif( "NOT_INSTALLED" == $app_status ){
                // Send to Installation Page
            }

        }
        $this->plugin->setOption($this->option);
        $this->appearance->setOption($this->option);
    }


    /**
     * Update API Response Status
     *
     * @param boolean $status
     * @return void
     */
    protected function updateResponseStatus($status)
    {
    	$this->response['success'] = (boolean) $status;
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
     * @param array $messages
     * @param string $type
     * @return void
     */
    protected function updateResponseMessage($messages, $type = "plain")
    {
        if( $type == 'plain' ){

    	   $this->response["messages"] = $messages;

        }elseif( $type == 'validation' ) {

            $formatted_messages = [];

            foreach ($messages as $field_name => $errors) {
                if( is_array($errors) ){
                    $formatted_messages[] = [
                        "type" => "ValidationError",
                        "message" => $errors[0]
                    ];
                }else{
                    $formatted_messages[] = [
                        "type" => "ValidationError",
                        "message" => $errors
                    ];
                }
            }

            $this->response["messages"] = array_values($formatted_messages);
        }
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
