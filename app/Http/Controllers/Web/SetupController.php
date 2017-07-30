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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SetupController extends Controller
{

    /**
     * Render Setup Page
     *
     * @return string
     */
    public function indexRender()
    {
        // Check if Setup is Closed
        if( env('CLOSE_SETUP', false) ){
            return redirect(route('home.notfound.render'));
        }

        $step = $this->setup->detectSetupStep();

        if( ($step > 3) || !(in_array($step, [ 2, 3 ])) ){
            # Send To Login After Setup
            return redirect(route('login'));
        }

        $step = str_replace([2, 3], ['options', 'admin'], $step);

        return view('guest.setup-' . $step, [
            'page_title' => trans('messages.setup_page_title'),
            'step' => $step,
            'errors' => [],
        ]);
    }
}