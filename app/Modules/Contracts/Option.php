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

interface Option {

	public function autoloadOptions($autoload);
	public function getOption($key, $serialized = false);
	public function insertOption($option_data);
	public function insertOptions($options_data);
	public function updateOption($where, $option_data);
	public function updateOptions($data);
	public function countOptions();

}