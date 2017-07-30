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


class DepartmentsController extends Controller
{

    /**
     * Departments List Page
     *
     * @return string
     */
    public function departmentsList()
    {
        return view('admin.departments-all', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Departments Add Page
     *
     * @return string
     */
    public function addDepartment()
    {
        return view('admin.departments-add', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Departments Edit Page
     *
     * @param integer $id
     * @return string
     */
    public function editDepartment($id)
    {
        return view('admin.departments-edit', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Departments View Page
     *
     * @param integer $id
     * @return string
     */
    public function viewDepartment($id)
    {
        return view('admin.departments-view', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}
