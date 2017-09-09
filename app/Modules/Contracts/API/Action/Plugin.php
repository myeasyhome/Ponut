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

interface Plugin {

	public function setOption(&$option);
    public function getPlugins();
    public function validatePlugin($plugin);
    public function activatePlugin($plugin);
    public function deactivatePlugin($plugin);
    public function deletePlugin($plugin);
    public function loadPlugin($plugin);

}