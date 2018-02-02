<?php

namespace Comment\Models;

use Comment\Support\Relations\HasManyChildComments;
use Comment\Support\Scopes\ApprovedScope;
use Comment\Support\Traits\HasOneParentComment;
use Comment\Support\Traits\CanBeVotedTrait;
use Frontier\Support\Traits\Ownable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Course;
use Pluma\Models\Model;
use Pluma\Models\User;
use User\Support\Traits\BelongsToUser;

class Comment extends Model
{
    use BelongsToUser,
        HasManyChildComments,
        HasOneParentComment,
        Ownable,
        CanBeVotedTrait,
        SoftDeletes;

    protected $with = ['user'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Only get all 'approved' comments.
        static::addGlobalScope(new ApprovedScope);
    }

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
