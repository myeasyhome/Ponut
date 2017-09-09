<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Contracts\API\Action;

interface Setup {

	public function getAppStatus();
	public function detectSetupStep();
	public function runSecondSetupStep($site_title, $site_email, $site_url);
	public function runThirdSetupStep($admin_username, $admin_email, $admin_password);

	public function countOptions();
	public function countUsers();
	public function getInitOptions($site_title, $site_email, $site_url);

	public function healthCheck();
}