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

use Ponut\Models\Department as DepartmentModel;
use Ponut\Models\DepartmentMeta as DepartmentMetaModel;
use Ponut\Modules\Contracts\Entities\Department as DepartmentContract;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Department implements DepartmentContract
{
    use DispatchesJobs;

    /**
     * Get Department
     *
     * @param array $where
     * @return mixed
     */
    public function getDepartment($where)
    {
        $department = DepartmentModel::where($where)->get()->toArray();

        if( count($department) > 0 ){
            return $department[0];
        }else{
            return false;
        }
    }

    /**
     * Get Department
     *
     * @param array  $where
     * @param integer $paginate
     * @return array
     */
    public function getDepartments($where, $paginate = 10)
    {
        if( count($where) > 0 ){
            return DepartmentModel::where($where)->paginate($paginate);
        }else{
            return DepartmentModel::all()->paginate($paginate);
        }
    }

    /**
     * Insert Department
     *
     * @param array $department_data
     * @return boolean
     */
    public function insertDepartment($department_data)
    {
        $department = new DepartmentModel;

        foreach ($department_data as $key => $value) {
            $department->$key = $value;
        }

        return (boolean) $department->save();
    }

    /**
     * Update Department
     *
     * @param array $where
     * @param array $department_data
     * @return boolean
     */
    public function updateDepartment($where, $department_data)
    {
        return (boolean) DepartmentModel::where($where)->update($department_data);
    }

    /**
     * Delete Department
     *
     * @param array $where
     * @return boolean
     */
    public function deleteDepartment($where)
    {
        return (boolean) DepartmentModel::where($where)->delete();
    }

    /**
     * Build a unique slug for department
     *
     * @param string $title
     * @return string
     */
    public function buildSlug($title)
    {
        $slug = str_slug($title, '-');

        if( !empty($slug) ){
            $i = 1;
            $found = $this->slugExist($slug);

            while ($found) {
                $slug = $slug + "-" + $i;
                $found = $this->slugExist($slug);
                $i += 1;
            }
        }else{
            $i = 1;
            $slug = $i;
            $found = $this->slugExist($slug);
            $i += 1;
            while ($found) {
                $slug = $i;
                $found = $this->slugExist($slug);
                $i += 1;
            }
        }

        return $slug;
    }

    /**
     * Check if slug exist
     *
     * @param string $slug
     * @return boolean
     */
    public function slugExist($slug, $id = false)
    {
        if( $id ){
            return (boolean) DepartmentModel::where('id', '<>', $id)->where('slug', '=', $slug)->count();
        }else{
            return (boolean) DepartmentModel::where('slug', '=', $slug)->count();
        }
    }

}