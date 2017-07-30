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


class AppearanceController extends Controller
{
    /**
     * Themes Page
     *
     * @return string
     */
    public function themesList()
    {
        return view('admin.appearance-themes', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Customize Page
     *
     * @return string
     */
    public function customizeTheme()
    {
        return view('admin.appearance-customize', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}
