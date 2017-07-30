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


class ProfileController extends Controller
{

    /**
     * Profile Page
     *
     * @return string
     */
    public function profile()
    {
        return view('admin.profile', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Notifications Page
     *
     * @return string
     */
    public function notifications()
    {
        return view('admin.notifications', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}
