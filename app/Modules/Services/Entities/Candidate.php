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

use Ponut\Modules\Contracts\Entities\Candidate as CandidateContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Candidate implements CandidateContract
{
    use DispatchesJobs;
}