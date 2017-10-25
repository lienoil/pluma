<?php

namespace Forum\Models;

use Frontier\Support\Traits\HasManyCategories;
use Frontier\Support\Traits\Ownable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Pluma\Models\User;
use Pluma\Support\Database\Scopes\Searchable;

class Forum extends Model
{
    // Searchable
    use Ownable, SoftDeletes;

    protected $with = ['user', 'comments'];

    // protected $searchables = ['name', 'code', 'description', 'created_at', 'updated_at'];

    /**
     * The alias for column `body`
     *
     * @return string
     */
    public function getContentAttribute()
    {
        return $this->body;
    }

    public function authors()
    {
        //
    }

    public function comment()
    {
        return $this->hasMany(\Pluma\Models\Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(\Pluma\Models\User::class);
    }

    public function comments()
    {
        return $this->morphMany(\Comment\Models\Comment::class, 'commentable');
    }
}
