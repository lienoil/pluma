<?php

namespace Activity\Models;

use Activity\Support\Relations\MorphToActivity;
use Pluma\Models\Model;

class Activity extends Model
{
    use MorphToActivity;

    protected $with = [];

    protected $searchables = ['created_at', 'updated_at'];

    protected $fillable = [
        'subject',
        'url',
        'method',
        'ip_address',
        'agent',
        'causer_id',
        'causer_type',
    ];
}
