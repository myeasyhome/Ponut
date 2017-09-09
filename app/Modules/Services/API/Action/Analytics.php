<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\API\Action;

use Ponut\Modules\Contracts\API\Action\Analytics as AnalyticsContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Analytics implements AnalyticsContract
{
    use DispatchesJobs;
}