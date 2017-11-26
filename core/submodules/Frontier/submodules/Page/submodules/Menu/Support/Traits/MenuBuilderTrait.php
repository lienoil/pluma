<?php

namespace Menu\Support\Traits;

use Crowfeather\Traverser\Traverser;
use Page\Models\Page;

trait MenuBuilderTrait
{
    /**
     * Stores the menu locations.
     *
     * @var array
     */
    protected $locations = [];

    /**
     * Gets the specified location.
     *
     * @return mixed
     */
    public static function location($code)
    {
        foreach (self::locations() as $location) {
            if ($location->code === $code) {
                return $location;
            }
        }

        return abort(404);
    }

    /**
     * Gets the menu locations from all the modules.
     *
     * @return array
     */
    public static function locations()
    {
        $instance = new static;

        $modules = get_modules_path();

        foreach ($modules as $key => $module) {
            if (file_exists("$module/config/locations.php")) {
                $locations = (array) require_once "$module/config/locations.php";
                foreach ($locations as $name => $location) {
                    $instance->locations[$name] = array_merge($location, [
                        'items' => $instance->where('location', $name)->get(),
                        'code' => $name,
                        'module' => basename($module)
                    ]);
                }
            }
        }

        return json_decode(json_encode($instance->locations));
    }

    /**
     * Initialize the builder.
     *
     * @param string $location
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function menus($location)
    {
        $instance = new static;

        $menus = $instance->where('location', $location)->orderBy('sort', 'ASC')->get();

        $traverser = new Traverser($menus->toArray(), ['root' => ['key' => 'root']], ['name' => 'key', 'parent' => 'parent', 'children' => 'children']);

        $menus = $traverser->reorderViaChildKnowsParent('parent');
        if (isset($menus['root'])) {
            unset($menus['root']);
        }

        $menus = $traverser->update($menus, function ($key, &$menu, &$parent) use ($traverser) {
            if (is_null($menu['page_id'])) {
                $menu['is_absolute_slug'] = true;
            }
        });

        return Traverser::recursiveArrayValues($menus, 'children');
    }

    /**
     * Gets the menus in the location `main-menu`.
     *
     * @return array
     */
    public static function pages()
    {
        $instance = new static;

        $pages = Page::select(['title', 'slug', 'code', 'id', 'parent_id'])->get();
        $traverser = new Traverser($pages->toArray(), ['root' => ['id' => 'root']], ['name' => 'id', 'parent' => 'parent_id']);

        $menus = $traverser->reorderViaChildKnowsParent('parent');

        if (isset($menus['root'])) {
            unset($menus['root']);
        }

        foreach ($menus as &$menu) {
            $menu['is_home'] = false;
            $menu['page_id'] = $menu['id'];
        }

        return Traverser::recursiveArrayValues($menus, 'children');
    }

    /**
     * Gets the menus in the location `social-menu`.
     *
     * @return array
     */
    public static function social()
    {
        $instance = new static;

        $menus = settings('social_menu', []);

        $traverser = new Traverser((array) $menus, ['root' => ['id' => 'root']], ['name' => 'id', 'parent' => 'parent_id']);

        $menus = Traverser::recursiveArrayValues($traverser->reorderViaChildKnowsParent(), 'children');

        if (isset($menus['root'])) {
            unset($menus['root']);
        }

        return json_decode(json_encode($menus));
    }
}
