<?php

namespace Course\Controllers;

use Bookmark\Models\Bookmark;
use Course\Models\Course;
use Course\Requests\CourseRequest;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use User\Models\User;

class BookmarkCourseController extends AdminController
{
    /**
     * Display list of bookmarked resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $resources = Course::onlyBookmarkedBy(user()->id)->get();

       return view("Theme::bookmarked.index")->with(compact("resources"));
    }

    /**
     * Bookmark the course.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function bookmark(Request $request, $id)
    {
        $bookmark = new Bookmark();
        $bookmark->user()->associate(user()->id);
        $course = Course::find($id);
        $course->bookmarks()->save($bookmark);

        return back();
    }

    /**
     * Delete the bookmark of the course.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function unbookmark(Request $request, $id)
    {
        try {
            $course = Course::find($id);
            $course->bookmarks()->where('user_id', user()->id)->delete();
        } catch (\Exception $e) {
            return back()->with($e->getMessage());
        } finally {
            return back();
        }
    }
}
