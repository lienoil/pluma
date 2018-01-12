<?php

namespace Widget\Composers;

use Pluma\Support\Composers\BaseViewComposer;

class WidgetViewComposer extends BaseViewComposer
{
    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'widgets';

    /**
     * The array of widgets.
     *
     * @var array
     */
    protected $widgets = [];

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    public function handle()
    {
        return json_decode(json_encode($this->compile()));
    }

    /**
     * Compile all widgets.
     *
     * @return Object
     */
    protected function compile()
    {
        return json_decode(json_encode($this->widgets()));
    }

    /**
     * Get all widgets.
     *
     * @return array
     */
    protected function widgets()
    {
        foreach ($this->modules() as $module) {
            if (file_exists("$module/config/widgets.php")) {
                $this->widgets = require_once "$module/config/widgets.php";
            }
        }

        return $this->widgets;
    }
}
