<?php

namespace Course\Models;

use Course\Controllers\Resources\CourseUserMutator;
use Course\Support\Relations\BelongsToManyCourses;
use Course\Support\Scopes\EnrolledToACourse;
use Illuminate\Database\Eloquent\Builder;
use User\Models\User as BaseUser;

class User extends BaseUser
{
    use EnrolledToACourse, BelongsToManyCourses, BelongsToManyContents, CourseUserMutator;

    protected $with = ['roles'];

    protected $appends = ['handlename', 'propername', 'displayname', 'displayrole', 'fullname', 'created', 'modified', 'enrolled'];

    protected $searchables = ['firstname', 'middlename', 'lastname', 'username', 'prefixname', 'email'];

}
