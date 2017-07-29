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
    public function exportRender()
    {
        return view('admin.tools-export', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    public function importRender()
    {
        return view('admin.tools-import', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    public function backupsRender()
    {
        return view('admin.tools-backups', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }
}
