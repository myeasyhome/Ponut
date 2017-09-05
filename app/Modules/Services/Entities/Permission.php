<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\Entities;

use Ponut\Models\Permission as PermissionModel;
use Ponut\Modules\Contracts\Permission as PermissionContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Permission implements PermissionContract
{
    use DispatchesJobs;

    /**
     * Add Permission
     *
     * @param array $data
     * @return boolean
     */
    public function addPermission($data)
    {

    	# Make sure that name not used before
    	if( $this->permissionExist(['name' => $data['name']]) ){
    		return false;
    	}

    	$permission = new PermissionModel;
    	$permission->name = $data['name'];
    	$permission->display_name = $data['display_name'];
    	$permission->description = $data['description'];
    	return (boolean) $permission->save();
    }

    /**
     * Edit Permission
     *
     * @param array $new_data
     * @param array $where
     * @return boolean
     */
    public function editPermission($new_data, $where)
    {
    	return (boolean) PermissionModel::where($where)->update($new_data);
    }

    /**
     * Check if Permission Exist
     *
     * @param array $where
     * @return boolean
     */
    public function permissionExist($where)
    {
    	return (boolean) (PermissionModel::where($where)->count() > 0);
    }

    /**
     * Check if Permission Exist with name
     *
     * @param array $where
     * @param mixed $id
     * @return boolean
     */
    public function checkPermission($name, $id = false)
    {
        if( $id ){
            return (boolean) (PermissionModel::where('id', '<>', $id)->where('name', $name)->count() > 0);
        }else{
            return (boolean) (PermissionModel::where('name', $name)->count() > 0);
        }
    }

    /**
     * Get Permission
     *
     * @param array $where
     * @return array
     */
    public function getPermission($where)
    {
    	$permission = PermissionModel::where($where)->get()->toArray();
    	if( !isset($permission[0]) ){
    		return false;
    	}
    	return $permission[0];
    }

    /**
     * Get Permissions
     *
     * @param array  $where
     * @param integer $paginate
     * @return array
     */
    public function getPermissions($where, $paginate = 20)
    {
        if( count($where) > 0 ){
            return PermissionModel::where($where)->paginate($paginate);
        }else{
            return PermissionModel::all()->paginate($paginate);
        }
    }

    /**
     * Delete Permission
     *
     * @param array $where
     * @return boolean
     */
    public function deletePermission($where)
    {
    	return (boolean) PermissionModel::where($where)->delete();
    }
}