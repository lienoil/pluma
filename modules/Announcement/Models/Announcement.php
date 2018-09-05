<?php

namespace Announcement\Models;

use Announcement\Support\Scopes\PublishedTrait;
// use Announcement\Support\Traits\AnnouncementMutator;
use Announcement\Support\Accessors\AnnouncementMutator;
use Category\Support\Relations\BelongsToCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Announcement extends Model
{
    use AnnouncementMutator, BelongsToCategory, BelongsToUser, PublishedTrait, SoftDeletes;

    protected $with = [];

    protected $fillable = ['id', 'name', 'code', 'body', 'feature'];

    protected $appends = [
        'author',
        'categoryname',
        'created',
        'excerpt',
        'expired',
        'modified',
        'published',
        'removed',
    ];

    protected $searchables = ['name', 'code', 'body', 'created_at', 'updated_at'];
}
