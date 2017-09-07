<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Modules\Services\Entities;

use Ponut\Modules\Contracts\Entities\Field as FieldContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Field implements FieldContract
{
    use DispatchesJobs;
}