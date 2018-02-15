<?php

namespace Pluma\Routing;

use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Routing\Router as BaseRouter;
use Pluma\Support\Route\SoftDeletesResourceRegistrar;

class Router extends BaseRouter
{
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'delete'];

    /**
     * Register an array of soft delete resource controllers.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\PendingResourceRegistration
     */
    public function softDeletes($name, $controller, array $options = [])
    {
        if ($this->container && $this->container->bound(SoftDeletesResourceRegistrar::class)) {
            $registrar = $this->container->make(SoftDeletesResourceRegistrar::class);
        } else {
            $registrar = new SoftDeletesResourceRegistrar($this);
        }

        return new PendingResourceRegistration(
            $registrar, $name, $controller, $options
        );
    }
}
