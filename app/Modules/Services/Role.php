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

use Ponut\Models\Role as RoleModel;
use Ponut\Models\Permission as PermissionModel;
use Ponut\Models\PermissionRole as PermissionRoleModel;
use Ponut\Modules\Contracts\Role as RoleContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Role implements RoleContract
{
    use DispatchesJobs;

    /**
     * Add Role
     *
     * @param array $data
     * @return boolean
     */
    public function addRole($data)
    {

    	# Make sure that name not used before
    	if( $this->roleExist(['name' => $data['name']]) ){
    		return false;
    	}

    	$role = new RoleModel;
    	$role->name = $data['name'];
    	$role->display_name = $data['display_name'];
    	$role->description = $data['description'];
    	return (boolean) $role->save();
    }

    /**
     * Edit Role
     *
     * @param array $new_data
     * @param array $where
     * @return boolean
     */
    public function editRole($new_data, $where)
    {
    	return (boolean) RoleModel::where($where)->update($new_data);
    }

    /**
     * Check if role exist
     *
     * @param array $where
     * @return boolean
     */
    public function roleExist($where)
    {
    	return (boolean) (RoleModel::where($where)->count() > 0);
    }

    /**
     * Check if role exist with name
     *
     * @param array $name
     * @param mixed $id
     * @return boolean
     */
    public function checkRole($name, $id = false)
    {
        if( $id ){
            return (boolean) (RoleModel::where('id', '<>', $id)->where('name', $name)->count() > 0);
        }else{
            return (boolean) (RoleModel::where(['name' => $name])->count() > 0);
        }
    }

    /**
     * Get Role
     *
     * @param array $where
     * @return array
     */
    public function getRole($where)
    {
    	$role = RoleModel::where($where)->get()->toArray();
    	if( !isset($role[0]) ){
    		return false;
    	}
    	return $role[0];
    }

    /**
     * Get Roles
     *
     * @param array  $where
     * @param integer $paginate
     * @return array
     */
    public function getRoles($where, $paginate = 20)
    {
        if( count($where) > 0 ){
            return RoleModel::where($where)->paginate($paginate);
        }else{
            return RoleModel::all()->paginate($paginate);
        }
    }

    /**
     * Delete Role
     *
     * @param array $where
     * @return boolean
     */
    public function deleteRole($where)
    {
    	return (boolean) RoleModel::where($where)->delete();
    }

    /**
     * Add Role Permissions
     *
     * @param string $role_name
     * @param array $permissions
     * @return boolean
     */
    public function addRolePermissions($role_name, $permissions)
    {
        $role = $this->getRole(['name' => $role_name]);

        if( $role == false ){
            return false;
        }

        $data = [];
        $role_id = $role['id'];
        foreach ($permissions as $permission_id) {
            $exist = PermissionModel::where('id', $permission_id)->count();
            if( !$exist ){
                continue;
            }
            $data[] = ['role_id' => $role_id, 'permission_id' => $permission_id];
        }

        if( empty($data) ){
            return true;
        }

        return (boolean) \DB::table(env('DB_TABLES_PREFIX', '') . 'permission_role')->insert($data);
    }

    /**
     * Update Role Permissions
     *
     * @param  string $role_name
     * @param  array $permissions
     * @return boolean
     */
    public function updateRolePermissions($role_name, $permissions)
    {
        $role = $this->getRole(['name' => $role_name]);

        if( $role == false ){
            return false;
        }

        $role_id = $role['id'];

        if( !empty($permissions) ){
            // delete some of the related permissions
            PermissionRoleModel::where('role_id', $role_id)->whereNotIn('permission_id', array_values($permissions))->delete();
        }else{
            // delete all related permissions
            PermissionRoleModel::where('role_id', $role_id)->delete();
            return true;
        }

        // Add new permissions
        foreach ($permissions as $permission_id) {
            $exist = PermissionRoleModel::where(['role_id'=> $role_id, 'permission_id' => $permission_id])->count();
            $permission_exist = PermissionModel::where('id', $permission_id)->count();
            if( !$exist && $permission_exist ){
                $new_permission_role = new PermissionRoleModel;
                $new_permission_role->role_id = $role_id;
                $new_permission_role->permission_id = $permission_id;
                $new_permission_role->save();
            }
        }

        return true;
    }
}