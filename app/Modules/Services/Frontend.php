<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services;

use Ponut\Modules\Contracts\Frontend as FrontendContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Frontend implements FrontendContract
{
    use DispatchesJobs;
}