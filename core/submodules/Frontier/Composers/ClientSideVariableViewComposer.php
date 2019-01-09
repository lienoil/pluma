<?php

namespace Frontier\Composers;

use Illuminate\Support\Facades\Cache;
use Pluma\Support\Composers\BaseViewComposer;
use Pluma\Support\Modules\Traits\ModulerTrait;

class ClientSideVariableViewComposer extends BaseViewComposer
{
    use ModulerTrait;

    /**
     * The view's variable.
     *
     * @var string
     */
    protected $name = 'clientVariables';

    /**
     * Handles the view to compose.
     *
     * @return Object|StdClass
     */
    public function handle()
    {
        return Cache::rememberForever('variables:js', function () {
            $modules = $this->getFileFromModules('config/variables.php');

            foreach ($modules as $module) {
                $collections[] = require $module;
            }

            return collect([
                'collections' => $collections ?? [],
                'debug' => config('debugging.debug'),
            ]);
        });
    }
}
