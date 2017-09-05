<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Contracts\Entities;

interface Department {

	public function getDepartment($where);
	public function getDepartments($where, $paginate = 10);
	public function insertDepartment($department_data);
	public function updateDepartment($where, $department_data);
	public function deleteDepartment($where);
	public function buildSlug($title);
	public function slugExist($slug, $id = false);

}