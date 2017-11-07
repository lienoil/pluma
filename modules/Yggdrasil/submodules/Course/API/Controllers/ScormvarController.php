<?php

namespace Course\API\Controllers;

use Catalogue\Models\Catalogue;
use Content\Models\Content;
use Course\Models\Course;
use Course\Models\Scormvar;
use Course\Models\User;
use Illuminate\Http\Request;
use Lock\Models\Unlock;
use Pluma\API\Controllers\APIController;

class ScormvarController extends APIController
{
    protected $cmiCoreCredit = "cmi.core.credit";
    protected $cmiCoreEntry = "cmi.core.entry";
    protected $cmiCoreLessonStatus = "cmi.core.lesson_status";
    protected $cmiCoreScoreRaw = "cmi.core.score.raw";
    protected $cmiCoreStudentName = "cmi.core.student_name";

    protected $returnedLMSGetValue = "";
    protected $noneOverridableOnCompletion = ["cmi.core.lesson_status", "cmi.core.score.raw"];

    /**
     * Initialize the resource.
     *
     * @param  Request $request
     * @param  int $course_id
     * @param  int $content_id
     * @return Illuminate\Http\Response
     */
    public function LMSInitialize(Request $request, $course_id, $content_id)
    {
        // cmiCoreCredit
        $scormvar = Scormvar::firstOrNew([
                                'course_id' => $course_id,
                                'content_id' => $content_id,
                                'user_id' => $request->input('user_id')?$request->input('user_id'):user()->id,
                                'name' => $this->cmiCoreCredit,
                            ]);
        if (! $scormvar->exists) {
            $scormvar->val = 'credit';
            $scormvar->save();
        }

        // cmiCoreLessonStatus
        $scormvar = Scormvar::firstOrNew([
                                'course_id' => $course_id,
                                'content_id' => $content_id,
                                'user_id' => $request->input('user_id')?$request->input('user_id'):user()->id,
                                'name' => $this->cmiCoreLessonStatus,
                            ]);
        if (! $scormvar->exists) {
            $scormvar->val = 'not attempted';
            $scormvar->save();
        }

        // cmiCoreEntry
        $scormvar = Scormvar::firstOrNew([
                                'course_id' => $course_id,
                                'content_id' => $content_id,
                                'user_id' => $request->input('user_id')?$request->input('user_id'):user()->id,
                                'name' => $this->cmiCoreEntry,
                            ]);
        if (! $scormvar->exists) {
            $scormvar->val = 'ab initio';
            $scormvar->save();
        }


        $scormvar = Scormvar::where('course_id', $course_id)
                            ->where('content_id', $content_id)
                            ->where('user_id', $request->input('user_id')?$request->input('user_id'):user()->id)
                            ->get();

        return response()->json($scormvar);
    }

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
                            ->where('user_id', $request->input('user_id')?$request->input('user_id'):user()->id)
                            ->get();

        return response()->json($scormvar);
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

    /**
      * Commit the resource.
     *
     * @param  Request $request
     * @param  int $course_id
     * @param  int $content_id
     * @return Illuminate\Http\Response
     */
    public function LMSCommit(Request $request, $course_id, $content_id)
    {
        try {
            foreach ($request->except('_token') as $varname => $value) {
                $scormvar = Scormvar::updateOrCreate([
                    'course_id' => $course_id,
                    'content_id' => $content_id,
                    'user_id' => $request->input('user_id') ? $request->input('user_id') : user()->id,
                    'name' => $varname,
                ], [
                    'val' => $value
                ]);
            }
        } catch (\Exception $e) {
            return response()->json("false", 500);
        } finally {
            $this->unlock($request, $course_id, $content_id);
        }

        return response()->json("true");
    }

    /**
      * Invoke the LMSFinish function.
     *
     * @param  Request $request
     * @param  int $course_id
     * @param  int $content_id
     * @return Illuminate\Http\Response
     */
    public function LMSFinish(Request $request, $course_id, $content_id)
    {
        $scormvar = Scormvar::where('course_id', $course_id)
                             ->where('content_id', $content_id)
                             ->where('user_id', $request->input('user_id') ? $request->input('user_id') : user()->id)
                             ->where('name', $this->cmiCoreLessonStatus)
                             ->where('val', 'completed')
                             ->first();

        if ($scormvar) {
            return "true";
        }

        return "false";
    }

    /**
     * Unlock the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $content_id
     * @return void
     */
    public function unlock(Request $request, $course_id, $content_id)
    {
        $scormvar = Scormvar::where('course_id', $course_id)
                             ->where('content_id', $content_id)
                             ->where('user_id', $request->input('user_id') ? $request->input('user_id') : user()->id)
                             ->where('name', $this->cmiCoreLessonStatus)
                             ->where('val', 'completed')
                             ->first();

            $content = Content::find($content_id);
            dd($content->course->unlocks);
            $content->course->unlocks()->save($content);
        if ($scormvar) {
        }
        // $unlock->user()->associate($request->input('user_id')?User::find($request->input('user_id')):user()->id);
    }
}
