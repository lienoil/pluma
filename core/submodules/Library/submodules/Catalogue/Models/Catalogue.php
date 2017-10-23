<?php

namespace Catalogue\Models;

use Catalogue\Support\Traits\HasManyLibraries;
use Catalogue\Support\Traits\MorphToCatalogable;
use Category\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Library\Models\Library;

class Catalogue extends Category
{
    use SoftDeletes, MorphToCatalogable, HasManyLibraries;

    protected $with = ['libraries'];

    protected $fillable = ['name', 'code', 'alias', 'description', 'icon'];

    protected $searchables = ['name', 'code', 'alias', 'description', 'icon', 'created_at', 'updated_at'];

    public static function mediabox()
    {
        $array[] = array(
            'count' => Library::count(),
            'name' => 'All',
            'icon' => 'perm_media',
            'url' => route('api.library.all')
        );

        foreach (self::all() as $i => $catalogue) {
            $array[$i+1]['id'] = $catalogue->id;
            $array[$i+1]['count'] = $catalogue->libraries->count();
            $array[$i+1]['name'] = $catalogue->name;
            $array[$i+1]['url'] = route('api.library.catalogue', [$catalogue->id]);
            $array[$i+1]['icon'] = $catalogue->icon;
        }

        return $array;
    }
}
