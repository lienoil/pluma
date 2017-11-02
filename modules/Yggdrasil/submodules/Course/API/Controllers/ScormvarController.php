<?php

namespace Course\API\Controllers;

use Catalogue\Models\Catalogue;
use Course\Models\Course;
use Course\Models\Scormvar;
use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;

class ScormvarController extends APIController
{
    protected $cmiCoreLessonStatus = "cmi.core.lesson_status";
    protected $cmiCoreScoreRaw = "cmi.core.score.raw";

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
                            ->where('user_id', user()->id)
                            ->where('name', $request->get('varname'))
                            ->first();
        if ($scormvar) {
            return $scormvar->val;
        }

        return "";
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
        $completed = Scormvar::where('course_id', $course_id)
                             ->where('content_id', $content_id)
                             ->where('user_id', user()->id)
                             ->where('name', $this->cmiCoreLessonStatus)
                             ->first();

        if (isset($completed->val) && $completed->val == 'completed' && $request->input('varname') == $this->cmiCoreScoreRaw) {
            // return "true";
        }

        $scormvar = Scormvar::firstOrNew([
                        'course_id' => $course_id,
                        'content_id' => $content_id,
                        'user_id' => user()->id,
                        'name' => $request->input('varname'),
                    ]);

        $scormvar->name = $request->input('varname');
        $scormvar->val = $request->input('value');
        $scormvar->save();

        return "true";
    }
}
