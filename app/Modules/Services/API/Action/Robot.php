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

use Ponut\Modules\Contracts\API\Action\Robot as RobotContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Robot implements RobotContract
{
    use DispatchesJobs;
}