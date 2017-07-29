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

class JobsController extends Controller
{

    /**
     * Jobs List Page Render
     *
     * @return string
     */
    public function indexRender()
    {
        return view('admin.jobs-all', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Jobs Add Page Render
     *
     * @return string
     */
    public function addRender()
    {
        return view('admin.jobs-add', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Jobs Edit Page Render
     *
     * @param integer $id
     * @return string
     */
    public function editRender($id)
    {
        return view('admin.jobs-edit', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Jobs View Page Render
     *
     * @param integer $id
     * @return string
     */
    public function viewRender($id)
    {
        return view('admin.jobs-view', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }
}
