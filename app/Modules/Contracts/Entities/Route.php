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

interface Route {

	public function addRoute($data);
	public function editRoute($new_data, $where);
	public function routeExist($where);
	public function checkRoute($name, $id = false);
	public function getRoute($where);
	public function getRoutes($where, $paginate = 20);
	public function deleteRoute($where);
	public function syncRoute();

}