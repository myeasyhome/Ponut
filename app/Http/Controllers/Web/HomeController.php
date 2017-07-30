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
use Ponut\Models\Option;
use Validator;
use Input;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{

    /**
     * Home Page
     *
     * @return string
     */
    public function landing()
    {
        ////////////////////////////////////////
        return view('guest.welcome');
        ////////////////////////////////////////

        return view('guest.home', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * 404 Page
     *
     * @return string
     */
    public function notfound()
    {
        return view('errors.404', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * 503 Page
     *
     * @return string
     */
    public function error()
    {
        return view('errors.503', [
            'page_title' =>  config('app.name')
        ]);
    }

    /**
     * Test Page
     *
     * @return string
     */
    public function test($flag)
    {
        if( !in_array($flag, ['api']) ){
            return redirect('/test/api');
        }

        $output = \Route::getRoutes();
        $routes = [];
        foreach ($output as $key => $value) {
            $routes[] = $value->uri;
        }

        return view('tests.base', [
            'page_title' =>  "Test - Ponut",
            'flag' => $flag,
            'routes' => $routes
        ]);
    }

    /**
     * Job Page
     *
     * @return string
     */
    public function jobs($dept_slug = false, $job_slug = false)
    {
        //~
    }
}
