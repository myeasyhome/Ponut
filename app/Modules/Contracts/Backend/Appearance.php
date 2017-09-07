<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Contracts\Backend;

interface Appearance {

	public function setOption(&$option);
    public function getThemes();
    public function validateTheme($theme);
    public function activateTheme($theme);
    public function deleteTheme($theme);
    public function customize($data);
    public function loadTheme($theme);

}