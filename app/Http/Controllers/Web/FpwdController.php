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


class FpwdController extends Controller
{

    /**
     * Forgot Password Page
     *
     * @return string
     */
    public function forgotPassword()
    {

        if( Auth::check() ){
            return redirect()->route('home.index.render');
        }

        return view('guest.forgot-password', [
            'page_title' => trans('messages.forgot_password_page_title') . " | {$this->option->getOption('_site_title')}"
        ]);
    }

    /**
     * Reset Password Page
     *
     * @param string $hash
     * @return string
     */
    public function resetPassword($hash)
    {
        if( Auth::check() ){
            return redirect()->route('home.index.render');
        }

        if ( !$this->user->isHashValid($hash) ){
            return redirect()->route('home.notfound.render');
        }

        return view('guest.reset-password', [
            'page_title' => trans('messages.reset_password_page_title') . " | {$this->option->getOption('_site_title')}",
            'hash' => $hash
        ]);
    }
}
