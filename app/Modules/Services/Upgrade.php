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

use Ponut\Modules\Contracts\Upgrade as UpgradeContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Upgrade implements UpgradeContract
{
    use DispatchesJobs;
}