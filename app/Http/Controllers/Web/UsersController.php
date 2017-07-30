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


class UsersController extends Controller
{

    /**
     * Users List Page
     *
     * @return string
     */
    public function usersList()
    {
        return view('admin.users-all', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Users Add Page
     *
     * @return string
     */
    public function addUser()
    {
        return view('admin.users-add', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Users Edit Page
     *
     * @return string
     */
    public function editUser($id)
    {
        return view('admin.users-edit', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}
