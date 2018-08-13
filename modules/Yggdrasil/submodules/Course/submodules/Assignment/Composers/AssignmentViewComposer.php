<?php

namespace Assignment\Composers;

use Assignment\Models\Assignment;
use Course\Models\User;
use Illuminate\View\View;
use Pluma\Support\Composers\BaseViewComposer;

class AssignmentViewComposer extends BaseViewComposer
{
    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'assignments';

    /**
     * Collection of assignments.
     *
     * @var array
     */
    protected $assignments;

    /**
     * Main function to tie everything together.
     *
     * @param  Illuminate\View\View   $view
     * @return void
     */
    public function compose(View $view)
    {
        parent::compose($view);

        $view->with($this->name(), $this->handle());
    }

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    protected function handle()
    {
        $user = User::find(user()->id);

        foreach ($user->courses as $course) {
            foreach ($course->lessons as $lesson) {
                if ($lesson->assignment()->exists()) {
                    $this->assignments[$lesson->assignment->code] = $lesson->assignment;
                }
            }
        }

        return $this->assignments ?? null;
    }
}
