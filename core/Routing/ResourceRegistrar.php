<?php

namespace Pluma\Routing;

use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Support\Str;

class ResourceRegistrar extends BaseResourceRegistrar
{
    /**
     * Get the action array for a resource route.
     *
     * @param  string  $resource
     * @param  string  $controller
     * @param  string  $method
     * @param  array   $options
     * @return array
     */
    protected function getResourceAction($resource, $controller, $method, $options)
    {
        $name = $this->getResourceRouteName($resource, $method, $options);

        $component = $this->getResourceComponent($name);

        $module = 'Pluma';

        $action = [
            'as' => $name,
            'uses' => $controller.'@'.$method,
            'module' => $module,
            'component' => 'components/'.$module.'/'.$component.'.vue',
        ];

        if (isset($options['middleware'])) {
            $action['middleware'] = $options['middleware'];
        }

        return $action;
    }

    /**
     * Get the component for a resource route.
     *
     * @param string $name
     * @return string
     */
    protected function getResourceComponent($name)
    {
        $component = explode('.', $name);

        foreach ($component as $i => &$string) {
            $string = $i === 0 ? ucfirst(str_singular($string)) : ucfirst($string);
        }

        return implode('/', $component);
    }
}
