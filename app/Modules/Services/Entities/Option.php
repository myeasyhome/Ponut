<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\Entities;

use Ponut\Models\Option as OptionModel;
use Ponut\Modules\Contracts\Entities\Option as OptionContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Option implements OptionContract
{
    use DispatchesJobs;

    private $options = [];

    /**
     * Load options
     *
     * @param string $autoload
     * @return boolean
     */
    public function autoloadOptions($autoload)
    {
        try {
            $options = OptionModel::where('autoload', $autoload)->get()->toArray();

            foreach ($options as $option) {
                $this->options[$option['op_key']] = $option['op_value'];
            }

            return (boolean)(count($this->options) > 0);
        } catch (\Exception $e) {

            return false;

        }
    }

    /**
     * Get Option
     *
     * @param string  $key
     * @param boolean $serialized
     * @return mixed
     */
    public function getOption($key, $serialized = false)
    {
        if( isset($this->options[$key]) ){
            return $this->options[$key];
        }

        $option = OptionModel::where('op_key', $key)->get()->toArray();

        if( count($option) > 0 ){
            $this->options[$key] = $option[0]['op_value'];
            if( $serialized ){
				$this->options[$key] = @unserialize($this->options[$key]);
            }
            return $this->options[$key];
        }else{
            return false;
        }
    }

    /**
     * Insert Option
     *
     * @param array $option_data
     * @return boolean
     */
    public function insertOption($option_data)
    {
        $option = new OptionModel;

        $option->op_key = $option_data['op_key'];
        $option->op_value = (is_array($option_data['op_value'])) ? serialize($option_data['op_value']) : $option_data['op_value'];
        $option->autoload = $option_data['autoload'];

        return (boolean) $option->save();
    }

    /**
     * Insert Options
     *
     * @param array $options_data
     * @return boolean
     */
    public function insertOptions($options_data)
    {
        return (boolean) \DB::table('options')->insert($options_data);

    }

    /**
     * Update Option
     *
     * @param array $where
     * @param array $option_data
     * @return boolean
     */
    public function updateOption($where, $option_data)
    {
        return (boolean) OptionModel::where($where)->update($option_data);
    }

    /**
     * Update Options
     *
     * @param array $data
     * @return boolean
     */
    public function updateOptions($data)
    {
        $result = true;
        foreach ($data as $key => $value) {
            $result &= $this->updateOption(['op_key' => $key], ['op_value' => $value]);
        }

        return (boolean) $result;
    }


    /**
     * Count Options
     *
     * @return integer
     */
    public function countOptions()
    {
        return OptionModel::all()->count();
    }

    public function updateApiRefreshToken()
    {
        $current_time = time();
        $api_refresh_token = $this->getOption('_api_refresh_token');
        $api_refresh_token_expire = $this->getOption('_api_refresh_token_expire');
        $old_refresh_token = $this->getOption('_api_old_refresh_token');

        // Check if token expired
        if( time() > $api_refresh_token_expire ){

            // refresh tokens
            $new_token = \Hash::make(str_random(20));
            $new_time = time() + config('auth.refresh_token_expire');
            $old_token = $api_refresh_token;

            if( $this->updateOption(['op_key' => '_api_refresh_token'], ['op_value' => $new_token]) ){
                $this->options['_api_refresh_token'] = $new_token;
            }
            if( $this->updateOption(['op_key' => '_api_refresh_token_expire'], ['op_value' => $new_time]) ){
                $this->options['_api_refresh_token_expire'] = $new_time;
            }
            if( $this->updateOption(['op_key' => '_api_old_refresh_token'], ['op_value' => $old_token]) ){
                $this->options['_api_old_refresh_token'] = $old_token;
            }
        }

        return true;
    }
}