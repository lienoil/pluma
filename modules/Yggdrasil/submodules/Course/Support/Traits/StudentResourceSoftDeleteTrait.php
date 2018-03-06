<?php

namespace Course\Support\Traits;

use Course\Models\Course;
use Illuminate\Http\Request;

trait StudentResourceSoftDeleteTrait
{

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $students = Course::onlyTrashed()
                    ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                    ->get();

        foreach ($students as $student) {
            $student->forceDelete();
        }

        return back();
    }
}
