<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Contracts;

interface Role {

	public function addRole($data);
	public function editRole($new_data, $where);
	public function roleExist($where);
	public function checkRole($name, $id = false);
	public function getRole($where);
	public function getRoles($where, $paginate = 20);
	public function deleteRole($where);
	public function addRolePermissions($role_name, $permissions);
	public function updateRolePermissions($role_name, $permissions);

}