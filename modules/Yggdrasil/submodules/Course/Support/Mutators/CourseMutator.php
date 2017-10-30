<?php

namespace Course\Support\Mutators;

use Course\Models\Course;
use Course\Models\User;

trait CourseMutator
{
    /**
     * Alias for BelongsToUser.
     *
     * @return \User\Models\User
     */
    public function getAuthorAttribute()
    {
        return $this->user;
    }

    /**
     * Get the lesson count
     *
     * @return string
     */
    public function getLessonsCountAttribute()
    {
        return $this->lessons->count() . ' ' .
            ($this->lessons->count() > 1 ? __('Lessons') : __('Lesson'));
    }

    /**
     * Enrolls a user as student.
     *
     * @param  int $course_id
     * @param  User   $user_id
     * @return void
     */
    public static function enrollUser($course_id, User $user_id)
    {
        $course = Course::findOrFail($course_id);
        $contents = array_column($course->contents->toArray(), 'id');

        $course->users()->where('user_id', $user_id)->detach();
        foreach ($course->contents as $content) {
            $prev = Content::where('sort', '<', $content->sort)->whereIn('id', $contents)->max('id');
            $current = $content->id;
            $next = Content::where('sort', '>', $content->sort)->whereIn('id', $contents)->min('id');
            $course->users()->attach(User::find($user_id), [
                'previous' => $prev,
                'current' => $current,
                'next' => $next,
                'status' => ! $prev ? 1 : 0,
            ]);
        }
    }
}
