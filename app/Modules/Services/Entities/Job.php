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

use Ponut\Models\Job as JobModel;
use Ponut\Models\JobMeta as JobMetaModel;
use Ponut\Modules\Contracts\Entities\Job as JobContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Job implements JobContract
{
    use DispatchesJobs;

    /**
     * Get a Job
     *
     * @param array $where
     * @return mixed
     */
    public function getJob($where)
    {
        $job = JobModel::where($where)->get()->toArray();

        if( count($job) > 0 ){
            return $job[0];
        }else{
            return false;
        }
    }

    /**
     * Get Jobs
     *
     * @param array  $where
     * @param integer $paginate
     * @return array
     */
    public function getJobs($where, $paginate = 10)
    {
        if( count($where) > 0 ){
            return JobModel::where($where)->paginate($paginate);
        }else{
            return JobModel::all()->paginate($paginate);
        }
    }

    /**
     * Insert a Job
     *
     * @param array $job_data
     * @return boolean
     */
    public function insertJob($job_data)
    {
        $job = new JobModel;

        foreach ($job_data as $key => $value) {
            $job->$key = $value;
        }

        return (boolean) $job->save();
    }

    /**
     * Update a Job
     *
     * @param array $where
     * @param array $job_data
     * @return boolean
     */
    public function updateJob($where, $job_data)
    {
        return (boolean) JobModel::where($where)->update($job_data);
    }

    /**
     * Delete a Job
     *
     * @param array $where
     * @return boolean
     */
    public function deleteJob($where)
    {
        return (boolean) JobModel::where($where)->delete();
    }
}