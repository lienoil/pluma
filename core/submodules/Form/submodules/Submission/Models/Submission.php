<?php

namespace Submission\Models;

use Form\Support\Relations\BelongsToForm;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pluma\Models\Model;
use Submission\Support\Traits\SubmissionMutatorTrait;
use User\Support\Traits\BelongsToUser;

class Submission extends Model
{
    use SoftDeletes, BelongsToForm, BelongsToUser, SubmissionMutatorTrait;

    protected $with = ['form'];

    protected $appends = ['author', 'created', 'modified', 'removed'];

    protected $searchables = ['created_at', 'updated_at'];
}
