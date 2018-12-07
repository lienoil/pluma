<?php

namespace Menu\Repositories;

use Menu\Models\Menu;
use Page\Models\Page;
use Pluma\Support\Repository\Repository;

class MenuRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Menu::class;

    protected $modeltype = 'menu';

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'menus' => 'array|required',
        ];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [];
    }

    /**
     * Retrieve the full model instance.
     *
     * @return \Pluma\Models\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Retrieve model resource details.
     *
     * @param string $code
     * @return  mixed
     */
    public function find($code)
    {
        $menu = $this->model->location($code);

        return $menu;
    }

    /**
     * Retrieve all available pages.
     *
     * @return \Page\Models\Page
     */
    public function pages()
    {
        $pages = Page::all();

        return $pages->map(function ($page) {
            $page['name'] = $page->title;
            $page['description'] = $page->code;
            $page['url'] = url($page->code);

            return $page;
        })->toArray();
    }

    /**
     * Retrieve the menu from a given location.
     *
     * @param string $location
     * @return mixed
     */
    public function location($location = null)
    {
        if (is_null($location)) {
            return [];
        }

        return json_decode(json_encode(array_merge(
            (array) $this->model->location($location), [
            'menus' => $this->model->menus($location),
        ])));
    }

    /**
     * Update model resource.
     *
     * @param array  $data
     * @param string $location
     */
    public function update(array $data, $location)
    {
        $this->model->where('location', $location)->delete();
        $menus = collect($data)->get('menus');

        foreach ($menus as $name => $fields) {
            $menu = new Menu();
            $menu->title = $fields['title'];
            $menu->slug = str_slug($fields['slug'] ?? $fields['code'] ?? $name);
            $menu->code = $fields['parent'].($fields['code'] ?? $name);
            $menu->key = $fields['parent'].($fields['code'] ?? $name);
            $menu->sort = $fields['sort'] ?? 0;
            $menu->icon = $fields['icon'] ?? null;
            $menu->parent = $fields['parent'];
            $menu->url = $this->cleanUrl($fields['url']);
            $menu->location = $location;
            $menu->type = $this->modeltype;
            $menu->save();
        }

        return $this->model->where('location', $location)->get();
    }

    /**
     * Clean URL strings.
     *
     * @param string $url
     * @return string
     */
    protected function cleanUrl($url): string
    {
        $url = str_replace("'", '', $url);

        return $url;
    }
}
