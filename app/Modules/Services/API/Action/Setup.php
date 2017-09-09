<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\API\Action;

use Ponut\Models\User as UserModel;
use Ponut\Models\Option as OptionModel;
use Ponut\Modules\Contracts\API\Action\Setup as SetupContract;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Ponut\Notifications\ThankYou;

class Setup implements SetupContract
{
    use DispatchesJobs;

    /**
     * Get App Status
     *
     * @return string
     */
    public function getAppStatus()
    {
        try {
            if (\DB::connection()->getDatabaseName()){

                if( \Schema::hasTable('options') ){
                    return "INSTALLED_OR_NO_RECORDS";
                }else{
                    return "NOT_INSTALLED";
                }
            }else{
                return $step;
            }
        } catch (\Exception $e) {
            return "DB_CONNECTION_ERROR";
        }
    }

    /**
     * Get Current Installation Step
     *
     * @return integer
     */
    public function detectSetupStep()
    {
        $step = 1;

        try {

            if (\DB::connection()->getDatabaseName()){

                $tables_exists = true;
                $tables_exists &= (boolean) \Schema::hasTable('options');

                if ($tables_exists){
                    $step += 1;
                }else{
                    if( !env('CLOSE_SETUP', false) ){
                        $migrate_status = (boolean) \Artisan::call('migrate');
                        if( $migrate_status ){
                            $step += 1;
                        }
                    }
                }
            }else{
                return $step;
            }
        } catch (\Exception $e) {
            return $step;
        }

        if( $this->countOptions() < count($this->getInitOptions('', '', '')) ){
            return $step;
        }else{
            $step += 1;
        }

        if( $this->countUsers() < 1 ){
            return $step;
        }else{
            $step += 1;
        }

        return $step;
    }

    /**
     * Run Second Installation Step
     *
     * @param string $site_title
     * @param string $site_email
     * @param string $site_url
     * @return boolean
     */
    public function runSecondSetupStep($site_title, $site_email, $site_url)
    {
        $options = $this->getInitOptions($site_title, $site_email, $site_url);
        return (boolean) \DB::table('options')->insert($options);
    }

    /**
     * Run Third Installation Step
     *
     * @param string $admin_username
     * @param string $admin_email
     * @param string $admin_password_hash
     * @return boolean
     */
    public function runThirdSetupStep($admin_username, $admin_email, $admin_password)
    {
        $user = new UserModel;
        $user->username = $admin_username;
        $user->first_name = '';
        $user->last_name = '';
        $user->email = $admin_email;
        $user->language = 'en_US';
        $user->job_title = '';
        $user->password = \Hash::make($admin_password);
        $user->api_token = \Hash::make(str_random(20));
        $user->api_token_expire = time() + config('auth.api_token_expire');
        $user->status = 'active';
        $user->remember_token = '';

        if( $user->save() ){
            return $user->id;
        }

        return false;
    }

    /**
     * Count Current Options
     *
     * @return integer
     */
    public function countOptions()
    {
    	return OptionModel::all()->count();
    }

    /**
     * Count Current users
     *
     * @return integer
     */
    public function countUsers()
    {
        return UserModel::all()->count();
    }

    /**
     * Get Initial Options
     *
     * @param string $site_title
     * @param string $site_email
     * @param string $site_url
     * @return array
     */
    public function getInitOptions($site_title, $site_email, $site_url)
    {
        return [
            [ 'op_key' => '_site_title', 'op_value' => $site_title, 'autoload' => 'on' ],
            [ 'op_key' => '_site_email', 'op_value' => $site_email, 'autoload' => 'on' ],
            [ 'op_key' => '_site_emails_sender', 'op_value' => $site_email, 'autoload' => 'on' ],
            [ 'op_key' => '_site_url', 'op_value' => $site_url, 'autoload' => 'on' ],
            [ 'op_key' => '_site_keywords', 'op_value' => '', 'autoload' => 'on' ],
            [ 'op_key' => '_site_description', 'op_value' => '', 'autoload' => 'on' ],
            [ 'op_key' => '_site_lang', 'op_value' => 'en_US', 'autoload' => 'on' ],
            [ 'op_key' => '_site_timezone', 'op_value' => 'America/New_York', 'autoload' => 'on' ],
            [ 'op_key' => '_site_maintainance_mode', 'op_value' => 'off', 'autoload' => 'on' ],
            [ 'op_key' => '_site_custom_styles', 'op_value' => '', 'autoload' => 'on' ],
            [ 'op_key' => '_site_custom_scripts', 'op_value' => '', 'autoload' => 'on' ],
            [ 'op_key' => '_site_tracking_codes', 'op_value' => '', 'autoload' => 'on' ],
            [ 'op_key' => '_cron_key', 'op_value' => substr(md5(rand()), 0, 20) . substr(md5(rand()), 0, 20), 'autoload' => 'on' ],
            [ 'op_key' => '_site_enabled_plugins', 'op_value' => serialize([]), 'autoload' => 'on' ],
            [ 'op_key' => '_site_enabled_theme', 'op_value' => 'default', 'autoload' => 'on' ],
            [ 'op_key' => '_site_appearance_customize', 'op_value' => serialize(['font' => 'bitter', 'skin' => 'default']), 'autoload' => 'on' ],
            [ 'op_key' => '_api_refresh_token', 'op_value' => \Hash::make(str_random(20)), 'autoload' => 'on' ],
            [ 'op_key' => '_api_refresh_token_expire', 'op_value' => time() + config('auth.refresh_token_expire'), 'autoload' => 'on' ],
            [ 'op_key' => '_api_old_refresh_token', 'op_value' => \Hash::make(str_random(20)), 'autoload' => 'on' ],
        ];
    }

    /**
     * Check App Health
     *
     * @return string
     */
    public function healthCheck()
    {
        //~
    }
}