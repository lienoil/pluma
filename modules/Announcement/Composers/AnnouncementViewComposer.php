<?php

namespace Announcement\Composers;

use Announcement\Models\Announcement;
use Illuminate\View\View;
use Pluma\Support\Composers\BaseViewComposer;

class AnnouncementViewComposer extends BaseViewComposer
{
    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'announcements';

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
        return Announcement::published()->get();
    }
}
