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
     * Settings General Page Render
     *
     * @return string
     */
    public function generalRender()
    {
        return view('admin.settings-general', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Settings Advanced Page Render
     *
     * @return string
     */
    public function advancedRender()
    {
        return view('admin.settings-advanced', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Settings Routes Page Render
     *
     * @return string
     */
    public function routesRender()
    {
        return view('admin.settings-routes', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Settings Roles Page Render
     *
     * @return string
     */
    public function rolesRender()
    {
        return view('admin.settings-roles', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Settings Permissions Page Render
     *
     * @return string
     */
    public function permissionsRender()
    {
        return view('admin.settings-permissions', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Settings About Page Render
     *
     * @return string
     */
    public function aboutRender()
    {
        return view('admin.settings-about', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }
}
