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


class ToolsController extends Controller
{

    /**
     * Export Page
     *
     * @return string
     */
    public function export()
    {
        return view('admin.tools-export', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Import Page
     *
     * @return string
     */
    public function import()
    {
        return view('admin.tools-import', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Backups Page
     *
     * @return string
     */
    public function backups()
    {
        return view('admin.tools-backups', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}
