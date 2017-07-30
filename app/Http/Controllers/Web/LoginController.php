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
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class LoginController extends Controller
{

    /**
     * Login Page
     *
     * @return string
     */
    public function login()
    {
    	if( Auth::check() ){
    		$url = Session::get('url.intended', route('admin.dashboard.index.render'));
    		if( strpos($url, 'admin') !== false ){
    			return redirect($url);
    		}
    		return redirect()->route('admin.dashboard.index.render');
    	}

        return view('guest.login', [
            'page_title' => "Login | {$this->option->getOption('_site_title')}",
        ]);
    }
}
