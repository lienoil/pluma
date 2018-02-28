<?php

namespace Course\Support\Traits;

use Content\Models\Content;
use Course\Models\User as Student;

trait CourseCommitTrait
{
    /**
     * Commits the changes to `content_user` table.
     *
     * @param int $content_id
     * @return void
     */
    public function commit($content_id)
    {
        try {
            $student = Student::find(user()->id);
            $current = $student->contents()
                        ->where('content_id', $content_id)
                        ->where('status', 'current')->first();
            if ($current) {
                $current->pivot->status = 'done';
                $current->pivot->save();
            }

            $next = $student->contents()->where('status', 'pending')->first();
            if ($next) {
                $next->pivot->status = 'current';
                $next->pivot->save();
            }
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }
}
