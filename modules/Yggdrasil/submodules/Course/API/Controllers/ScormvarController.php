<?php

namespace Course\API\Controllers;

use Catalogue\Models\Catalogue;
use Course\Models\Course;
use Course\Models\Scormvar;
use Course\Models\User;
use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;

class ScormvarController extends APIController
{
    protected $cmiCoreLessonStatus = "cmi.core.lesson_status";
    protected $cmiCoreScoreRaw = "cmi.core.score.raw";
    protected $cmiCoreStudentName = "cmi.core.student_name";

    protected $returnedLMSGetValue = "";
    protected $noneOverridableOnCompletion = ["cmi.core.lesson_status", "cmi.core.score.raw"];

    /**
     * Get the resource.
     *
     * @param  Request $request
     * @param  int $course_id
     * @param  int $content_id
     * @return Illuminate\Http\Response
     */
    public function LMSGetValue(Request $request, $course_id, $content_id)
    {
        $scormvar = Scormvar::where('course_id', $course_id)
                            ->where('content_id', $content_id)
                            ->where('user_id', $request->input('user_id'))
                            ->where('name', $request->get('varname'))
                            ->first();

        switch ($request->get('varname')) {
            case $this->cmiCoreStudentName:
                $this->returnedLMSGetValue = User::find($request->input('user_id')?$request->input('user_id'):user()->id)->displayname;
                break;

            default:
                if ($scormvar) {
                    $this->returnedLMSGetValue = $scormvar->val;
                }
                break;
        }

        // return empty if not found
        return $this->returnedLMSGetValue;
    }

    /**
     * Set the resource.
     *
     * @param  Request $request
     * @param  int $course_id
     * @param  int $content_id
     * @return Illuminate\Http\Response
     */
    public function LMSSetValue(Request $request, $course_id, $content_id)
    {
        if (empty($request->input('varname'))) {
            return "false";
        }

        /**
         * This code will check if the value being set
         * is already present in the database. If so, exit.
         * Since we don't want the user, taking the exam multiple times.
         *
         * @var Course\Models\Scormvar
         */
        $completed = Scormvar::where('course_id', $course_id)
                             ->where('content_id', $content_id)
                             ->where('user_id', $request->input('user_id') ? $request->input('user_id') : user()->id)
                             ->where('name', $this->cmiCoreLessonStatus)
                             ->where('val', 'completed')
                             ->first();

        if ($completed && in_array($request->input('varname'), $this->noneOverridableOnCompletion)) {
            return "false";
        }

        // Else save
        $scormvar = Scormvar::firstOrNew([
                        'course_id' => $course_id,
                        'content_id' => $content_id,
                        'user_id' => $request->input('user_id') ? $request->input('user_id') : user()->id,
                        'name' => $request->input('varname'),
                    ]);

        $scormvar->course_id = $course_id;
        $scormvar->content_id = $content_id;
        $scormvar->user_id = $request->input('user_id') ? $request->input('user_id') : user()->id;
        switch ($request->input('varname')) {
            case $this->cmiCoreStudentName:
                $scormvar->name = $request->input('varname');
                $scormvar->val = user()->displayname;
                break;

            default:
                $scormvar->name = $request->input('varname');
                $scormvar->val = $request->input('value');
                break;
        }
        $scormvar->save();

        return "true";
    }
}
