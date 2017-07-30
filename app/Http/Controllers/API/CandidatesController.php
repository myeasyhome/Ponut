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
    public function editCandidate($id)
    {
        //~
    }

    /**
     * Delete Candidate
     *
     * @return string
     */
    public function deleteCandidate($id)
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

        $this->updateResponseStatus($result);
        $this->updateResponseMessage([
            "code" => ($result) ? 'success' : 'db_error',
            "messages" => [
                [
                    "type" => ($result) ? 'success' : 'error',
                    "message" =>  ($result) ? trans('messages.delete_candidate_success_message') : trans('messages.delete_candidate_error_message')
                ]
            ]
        ], "plain");

        return response()->json($this->getResponse());
    }
}