<?php

namespace Course\API\Controllers;

class BookmarkCourseController extends APIController
{
    /**
     *Bookmark the course.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function bookmark(Request $request, $id)
    {
        $course = Course::find($id);
        $bookmark = new Bookmark();
        $bookmark->user()->associate(user()->id);
        $course->bookmarks()->save($bookmark);

        return response()->json($this->successResponse);
    }

    /**
     * Delete the bookmark of the course.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function unbookmark(Request $request, $id)
    {
        try {
            $course = Course::find($id);
            $course->bookmarks()->where('user_id', user()->id)->delete();
        } catch (\Exception $e) {
            return reponse()->json($e->getMessage());
        } finally {
            return response()->json($this->successResponse);
        }
    }
}
