<?php

namespace Comment\Models;

use Frontier\Support\Traits\Ownable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Course;
use Pluma\Models\Model;
use Pluma\Models\User;
use Pluma\Support\Database\Scopes\Searchable;

class Comment extends Model
{
    // use SoftDeletes;
    use Ownable, SoftDeletes, Searchable;

    public function post()
    {
        return $this->belongsto(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(\Pluma\Models\User::class);
    }

    public function authors()
    {
        //
    }

    public function course()
    {
        return $this->belongsTo(\Pluma\Models\Course::class);
    }

    public function forum()
    {
        return $this->hasMany(\Pluma\Models\Forum::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function votes()
    {
        return $this->morphMany(\Pluma\Models\Vote::class, 'votable');
    }
}
