<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Http\Controllers\Web;

use Ponut\Http\Controllers\Controller;

use Validator;
use Input;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class SettingsController extends Controller
{

    /**
     * Settings General Page
     *
     * @return string
     */
    public function general()
    {
        return view('admin.settings-general', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Settings Advanced Page
     *
     * @return string
     */
    public function advanced()
    {
        return view('admin.settings-advanced', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Settings Routes Page
     *
     * @return string
     */
    public function routes()
    {
        return view('admin.settings-routes', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Settings Roles Page
     *
     * @return string
     */
    public function roles()
    {
        return view('admin.settings-roles', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Settings Permissions Page
     *
     * @return string
     */
    public function permissions()
    {
        return view('admin.settings-permissions', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Settings About Page
     *
     * @return string
     */
    public function about()
    {
        return view('admin.settings-about', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}
