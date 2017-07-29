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

class CandidatesController extends Controller
{

    /**
     * Candidates List Page Render
     *
     * @return string
     */
    public function indexRender()
    {
        return view('admin.candidates-all', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Candidates Add Page Render
     *
     * @return string
     */
    public function addRender()
    {
        return view('admin.candidates-add', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Candidates View Page Render
     *
     * @param integer $id
     * @return string
     */
    public function viewRender($id)
    {
        return view('admin.candidates-view', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }
}
