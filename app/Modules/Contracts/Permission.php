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

interface Permission {

	public function addPermission($data);
	public function editPermission($new_data, $where);
	public function permissionExist($where);
	public function checkPermission($name, $id = false);
	public function getPermission($where);
	public function getPermissions($where, $paginate = 20);
	public function deletePermission($where);

}