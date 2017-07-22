<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services;

use Ponut\Models\Route as RouteModel;
use Ponut\Modules\Contracts\Route as RouteContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Route implements RouteContract
{
    use DispatchesJobs;

    /**
     * Add Route
     *
     * @param array $data
     * @return boolean
     */
    public function addRoute($data)
    {
        # Make sure that name not used before
        if( $this->routeExist(['name' => $data['name']]) ){
            return false;
        }

        $route = new RouteModel;
        $route->name = $data['name'];
        $route->method = $data['method'];
        $route->uri = $data['uri'];
        $route->action = $data['action'];
        $route->permission_id = (isset($data['permission_id'])) ? $data['permission_id'] : '0';
        $route->enabled = $data['enabled'];

        return (boolean) $route->save();
    }

    /**
     * Edit Route
     *
     * @param array $new_data
     * @param array $where
     * @return boolean
     */
    public function editRoute($new_data, $where)
    {
        return (boolean) RouteModel::where($where)->update($new_data);
    }

    /**
     * Check if route exist
     *
     * @param array $where
     * @return boolean
     */
    public function routeExist($where)
    {
        return (boolean) (RouteModel::where($where)->count() > 0);
    }

    /**
     * Check if route exist with name
     *
     * @param array $name
     * @param mixed $id
     * @return boolean
     */
    public function checkRoute($name, $id = false)
    {
        if( $id ){
            return (boolean) (RouteModel::where('id', '<>', $id)->where('name', $name)->count() > 0);
        }else{
            return (boolean) (RouteModel::where(['name' => $name])->count() > 0);
        }
    }

    /**
     * Get Route
     *
     * @param array $where
     * @return array
     */
    public function getRoute($where)
    {
        $route = RouteModel::where($where)->get()->toArray();
        if( !isset($route[0]) ){
            return false;
        }
        return $route[0];
    }

    /**
     * Get Routes
     *
     * @param array  $where
     * @param integer $paginate
     * @return array
     */
    public function getRoutes($where, $paginate = 20)
    {
        if( count($where) > 0 ){
            return RouteModel::where($where)->paginate($paginate);
        }else{
            return RouteModel::all()->paginate($paginate);
        }
    }

    /**
     * Delete Route
     *
     * @param array $where
     * @return boolean
     */
    public function deleteRoute($where)
    {
        return (boolean) RouteModel::where($where)->delete();
    }

    /**
     * Sync Routes
     *
     * @return boolean
     */
    public function syncRoute()
    {
        // Build Routes List
        $files_routes_list = \Route::getRoutes();

        $enhanced_routes_list = [];
        foreach ($files_routes_list as $key => $value) {
            $enhanced_routes_list[$value->action['as']] = [
                'name' => $value->action['as'],
                'method' => implode('|', array_values($value->methods)),
                'uri' => $value->uri,
                'action' => $value->action['uses']
            ];
        }

        // Delete old route
        RouteModel::whereNotIn('name', array_keys($enhanced_routes_list))->delete();

        // Update Current Routes
        foreach ($enhanced_routes_list as $name => $route) {
            $db_route = RouteModel::where('name', $name)->get()->toArray();
            if( empty($db_route) ){
                $this->addRoute([
                    'name' => $route['name'],
                    'method' => $route['method'],
                    'uri' => $route['uri'],
                    'action' => $route['action'],
                    'permission_id' => '0',
                    'enabled' => 'on',
                ]);
            }else{
                $db_route = $db_route[0];

                if( ($db_route['name'] != $route['name']) || ($db_route['method'] != $route['method']) || ($db_route['uri'] != $route['uri']) || ($db_route['action'] != $route['action']) ){
                    $this->editRoute(['method' => $route['method'], 'uri' => $route['uri'], 'action' => $route['action']], ['name' => $route['name']]);
                }
            }
        }

        return true;
    }
}