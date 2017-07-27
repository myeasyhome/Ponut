<?php

namespace Ponut\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Auth;
use Ponut\Modules\Contracts\Analytics as AnalyticsContract;
use Ponut\Modules\Contracts\Backend as BackendContract;
use Ponut\Modules\Contracts\Candidate as CandidateContract;
use Ponut\Modules\Contracts\Department as DepartmentContract;
use Ponut\Modules\Contracts\Field as FieldContract;
use Ponut\Modules\Contracts\Frontend as FrontendContract;
use Ponut\Modules\Contracts\Job as JobContract;
use Ponut\Modules\Contracts\Option as OptionContract;
use Ponut\Modules\Contracts\Permission as PermissionContract;
use Ponut\Modules\Contracts\Robot as RobotContract;
use Ponut\Modules\Contracts\Role as RoleContract;
use Ponut\Modules\Contracts\Setup as SetupContract;
use Ponut\Modules\Contracts\Upgrade as UpgradeContract;
use Ponut\Modules\Contracts\User as UserContract;
use Ponut\Modules\Contracts\Notify as NotifyContract;
use Ponut\Modules\Contracts\Appearance as AppearanceContract;
use Ponut\Modules\Contracts\Plugin as PluginContract;
use Ponut\Modules\Contracts\Route as RouteContract;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $response = [
    	"success" => false,
    	"payload" => [],
    	"message" => []
    ];

    protected $analytics;
    protected $backend;
    protected $candidate;
    protected $department;
    protected $field;
    protected $frontend;
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
    public function __construct( AnalyticsContract $analytics, BackendContract $backend, CandidateContract $candidate, DepartmentContract $department, FieldContract $field, FrontendContract $frontend, JobContract $job, OptionContract $option, PermissionContract $permission, RobotContract $robot, RoleContract $role, SetupContract $setup, UpgradeContract $upgrade, UserContract $user, NotifyContract $notify, Request $request, PluginContract $plugin, AppearanceContract $appearance, RouteContract $route)
    {

        $this->analytics = $analytics;
        $this->backend = $backend;
        $this->candidate = $candidate;
        $this->department = $department;
        $this->field = $field;
        $this->frontend = $frontend;
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

        $this->option->autoloadOptions('on');
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
