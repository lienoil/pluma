<?php

namespace Course\Support\Traits;

use Illuminate\Http\Request;
use Menu\Models\Menu;
use Course\Models\Course;

trait CourseResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = []; // Course::search($request->all())->paginate();

        return view("Theme::courses.all")->with(compact('resources'));
    }

    /**
     * Try to retrieve the resource of the given slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $code
     * @return Illuminate\Http\Response
     */
    public function single(Request $request, $code = null)
    {
        $menu = Menu::whereSlug(
            is_null($code) ? settings('site_home', 'home') : $code
        );

        if ($menu->exists()) {
            $menu = $menu->first();
            $course = Course::codeOrFail($menu->code);

            // Check if template exists.
            $template = is_null($course->template) ? 'generic' : $course->template;
            if (view()->exists("Theme::templates.$template")) {
                return view("Theme::templates.$template")
                            ->with(compact('course'));
            }

            // Check if a course exists.
            if (view()->exists("Theme::courses.{$course->code}")) {
                return view("Theme::courses.{$course->code}")
                            ->with(compact('course'));
            }

            // Default to the index course.
            return view("Theme::templates.index")->compact('course');
        }

        // The $code does not exist on the app's menus.
        // Try if a static file exists for the $code.
        if (view()->exists("Theme::static.$code")) {
            return view("Theme::static.$code");
        }

        // Try the generic Static hintpath
        if (view()->exists("Static::$code")) {
            return view("Static::$code");
        }

        // Finally, give up your dreams.
        return abort(404);
    }
}
