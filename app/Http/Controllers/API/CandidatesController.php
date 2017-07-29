<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Http\Controllers\API;

use Ponut\Http\Controllers\Controller;

use Validator;
use Input;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CandidatesController extends Controller
{
    /**
     * Add Candidate
     *
     * @return string
     */
	public function addCandidate()
	{
		//~
	}

    /**
     * Edit Candidate
     *
     * @return string
     */
	public function editCandidate()
	{
        //~
	}

    /**
     * Delete Candidate
     *
     * @return string
     */
	public function deleteCandidate()
	{
        $validator = Validator::make($this->request->all(), [
            'id' => 'required|integer'
        ], [
            'id.required' => trans('messages.delete_candidate_error_id_required'),
            'id.integer' => trans('messages.delete_candidate_error_id_integer'),
        ]);

        if ($validator->fails()) {
            $this->updateResponseStatus(false);
            $this->updateResponseMessage($validator->errors(), "validation");
            return response()->json($this->getResponse());
        }

        $result = $this->candidate->deleteCandidate([
            'id' => $this->request->input('id')
        ]);

        return response()->json([
            'status' => ($result) ? 'success' : 'error',
            'messages' => ($result) ? ["form" => [trans('messages.delete_candidate_success_message')]] : ["form" => [trans('messages.delete_candidate_error_message')]],
            'data' => [],
        ]);
	}
}