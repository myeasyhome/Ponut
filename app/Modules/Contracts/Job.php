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

interface Job {

	public function getJob($where);
	public function getJobs($where, $paginate = 10);
	public function insertJob($job_data);
	public function updateJob($where, $job_data);
	public function deleteJob($where);

}