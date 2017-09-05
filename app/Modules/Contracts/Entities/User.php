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

interface User {

	public function getUser($where);
	public function getUsers($where, $paginate = 10);
	public function insertUser($user_data);
	public function updateUser($where, $user_data);
	public function deleteUser($where);
	public function userExist($where);
	public function countUsers();
	public function countUsersBy($where);
	public function checkUsername($username, $id = false);
	public function checkEmail($email, $id = false);
	public function clearOldTokens($email);
	public function resetRequestWithUsername($username);
	public function resetRequestWithEmail($email);
	public function setNewPassword($hash, $new_password);
	public function isHashValid($hash);
	public function getApiData($username);
	public function refreshAccessToken($user_id);

}