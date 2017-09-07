<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\Backend;

use Ponut\Modules\Contracts\Backend\Appearance as AppearanceContract;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\File;

class Appearance implements AppearanceContract
{
    use DispatchesJobs;

    private $option;

    /**
     * Set Option Object
     *
     * @param object &$option
     */
    public function setOption(&$option)
    {
    	$this->option = $option;
    }

    /**
     * Get Themes
     *
     * @return array
     */
    public function getThemes()
    {
    	$themes = File::directories(base_path('resources/themes'));
    	$themes_list = [];

    	foreach ($themes as $theme) {
    		if( (!in_array($theme, ['.', '..'])) & ($this->validateTheme($theme)) ){
    			$themes_list[] = $theme;
    		}
    	}

    	return $themes_list;
    }

    /**
     * Validate Theme
     *
     * @param string $theme
     * @return boolean
     */
    public function validateTheme($theme)
    {
    	if( !File::isDirectory(base_path("resources/themes/{$theme}/")) ){
    		return false;
    	}

    	if( !File::isDirectory(base_path("resources/themes/{$theme}/templates/")) ){
    		return false;
    	}

    	if( !File::isFile(base_path("resources/themes/{$theme}/{$theme}.php")) || !File::exists(base_path("resources/themes/{$theme}/{$theme}.php")) ){
    		return false;
    	}

    	if( !File::isFile(base_path("resources/themes/{$theme}/{$theme}.png")) || !File::exists(base_path("resources/themes/{$theme}/{$theme}.png")) ){
    		return false;
    	}

    	return true;
    }

    /**
     * Activate Theme
     *
     * @param string $theme
     * @return boolean
     */
    public function activateTheme($theme)
    {
    	$enabled_theme = $this->option->getOption('_site_enabled_theme', true);
    	if( $theme == $enabled_theme ){
    		return true;
    	}

        if( !$this->validateTheme($theme) ){
            return false;
        }

    	return (boolean) $this->option->updateOption(['op_key' => '_site_enabled_theme'], ['op_value' => $theme]);
    }

    /**
     * Delete Theme
     *
     * @param string $theme
     * @return boolean
     */
    public function deleteTheme($theme)
    {
    	$enabled_theme = $this->option->getOption('_site_enabled_theme', false);
    	if( $theme == $enabled_theme ){
    		return false;
    	}

        if( !$this->validateTheme($theme) ){
            return false;
        }

    	try {
    		$status = (boolean) File::cleanDirectory(base_path("resources/themes/{$theme}"));
    		$status &= (boolean)File::deleteDirectory(base_path("resources/themes/{$theme}"));
    		return (boolean) $status;
    	} catch (\Exception $e) {
    		return false;
    	}
    }

    /**
     * Customize Theme
     *
     * @param array $data
     * @return boolean
     */
    public function customize($data)
    {
    	$customize_data = $this->option->getOption('_site_appearance_customize', true);
    	foreach ($data as $key => $value) {
    		$customize_data[$key] = $value;
    	}

    	return (boolean) $this->option->updateOption(['op_key' => '_site_appearance_customize'], ['op_value' => serialize($customize_data)]);
    }

    public function loadTheme($theme)
    {

    }

}