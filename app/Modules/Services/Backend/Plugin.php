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

use Ponut\Modules\Contracts\Backend\Plugin as PluginContract;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\File;

class Plugin implements PluginContract
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
     * Get Plugins
     *
     * @return array
     */
    public function getPlugins()
    {
    	$plugins = File::directories(base_path('plugins'));
    	$plugins_list = [];

    	foreach ($plugins as $plugin) {
    		if( (!in_array($plugin, ['.', '..'])) & ($this->validatePlugin($plugin)) ){
    			$plugins_list[] = $plugin;
    		}
    	}

    	return $plugins_list;
    }

    /**
     * Validate Plugin
     *
     * @param string $plugin
     * @return boolean
     */
    public function validatePlugin($plugin)
    {
    	if( !File::isDirectory(base_path("/plugins/{$plugin}")) ){
    		return false;
    	}

    	if( !File::isFile(base_path("plugins/{$plugin}/{$plugin}.php")) || !File::exists(base_path("plugins/{$plugin}/{$plugin}.php")) ){
    		return false;
    	}

    	if( !File::isFile(base_path("plugins/{$plugin}/{$plugin}.png")) || !File::exists(base_path("plugins/{$plugin}/{$plugin}.png")) ){
    		return false;
    	}

    	return true;
    }

    /**
     * Activate Plugin
     *
     * @param string $plugin
     * @return boolean
     */
    public function activatePlugin($plugin)
    {
    	$enabled_plugins = $this->option->getOption('_site_enabled_plugins', true);
    	if( in_array($plugin, array_values($enabled_plugins)) ){
    		return true;
    	}

        if( !$this->validatePlugin($plugin) ){
            return false;
        }

    	$enabled_plugins[] = $plugin;

    	return (boolean) $this->option->updateOption(['op_key' => '_site_enabled_plugins'], ['op_value' => serialize($enabled_plugins)]);
    }

    /**
     * Deactivate Plugin
     *
     * @param string $plugin
     * @return boolean
     */
    public function deactivatePlugin($plugin)
    {
    	$enabled_plugins = $this->option->getOption('_site_enabled_plugins', true);
    	if( !in_array($plugin, array_values($enabled_plugins)) ){
    		return true;
    	}

    	$key = array_search($plugin, $enabled_plugins);
    	unset($enabled_plugins[$key]);

    	return (boolean) $this->option->updateOption(['op_key' => '_site_enabled_plugins'], ['op_value' => serialize($enabled_plugins)]);
    }

    /**
     * Delete Plugin
     *
     * @param string $plugin
     * @return boolean
     */
    public function deletePlugin($plugin)
    {
    	$enabled_plugins = $this->option->getOption('_site_enabled_plugins', true);
    	if( in_array($plugin, array_values($enabled_plugins)) ){
    		return false;
    	}

        if( !$this->validatePlugin($plugin) ){
            return false;
        }

        try {
            $status = (boolean) File::cleanDirectory(base_path("plugins/{$plugin}"));
            $status &= (boolean) File::deleteDirectory(base_path("plugins/{$plugin}"));
            return (boolean) $status;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function loadPlugin($plugin)
    {

    }
}