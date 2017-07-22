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

use Ponut\Modules\Contracts\Backend as BackendContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Backend implements BackendContract
{
    use DispatchesJobs;

}