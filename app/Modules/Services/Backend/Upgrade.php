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

use Ponut\Modules\Contracts\Backend\Upgrade as UpgradeContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Upgrade implements UpgradeContract
{
    use DispatchesJobs;
}