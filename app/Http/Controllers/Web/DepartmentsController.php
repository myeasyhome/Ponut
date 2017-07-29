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
     * Departments List Page Render
     *
     * @return string
     */
    public function indexRender()
    {
        return view('admin.departments-all', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Departments Add Page Render
     *
     * @return string
     */
    public function addRender()
    {
        return view('admin.departments-add', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Departments Edit Page Render
     *
     * @param integer $id
     * @return string
     */
    public function editRender($id)
    {
        return view('admin.departments-edit', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Departments View Page Render
     *
     * @param integer $id
     * @return string
     */
    public function viewRender($id)
    {
        return view('admin.departments-view', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }
}
