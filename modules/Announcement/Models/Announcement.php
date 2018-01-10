<?php

namespace Announcement\Models;

use Announcement\Support\Traits\AnnouncementMutator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;

class Announcement extends Model
{
    use SoftDeletes, AnnouncementMutator;

    protected $with = [];

    protected $appends = ['published', 'expired', 'modified'];

    protected $searchables = ['name', 'code', 'body', 'created_at', 'updated_at'];
}
