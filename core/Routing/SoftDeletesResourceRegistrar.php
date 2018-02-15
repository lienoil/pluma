<?php

namespace Pluma\Routing;

use Illuminate\Routing\ResourceRegistrar;

class SoftDeletesResourceRegistrar extends ResourceRegistrar
{
    /**
     * The default actions for a resourceful controller.
     *
     * @var array
     */
    protected $resourceDefaults = ['trashed', 'delete', 'restore'];

    /**
     * The verbs used in the resource URIs.
     *
     * @var array
     */
    protected static $verbs = [
        'trashed' => 'trashed',
        'delete' => 'delete',
    ];

    /**
     * Add the trashed method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceTrashed($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/'.static::$verbs['trashed'];

        $action = $this->getResourceAction($name, $controller, 'trashed', $options);

        return $this->router->get($uri, $action);
    }
}
