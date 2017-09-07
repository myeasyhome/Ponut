<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\Backend;

use Ponut\Modules\Contracts\Backend\Analytics as AnalyticsContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Analytics implements AnalyticsContract
{
    use DispatchesJobs;
}