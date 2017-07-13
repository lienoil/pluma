<?php

namespace Frontier\Models;

use Pluma\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $appends = ['time'];

    public function getTimeAttribute()
    {
        return $this->created_at->timestamp;
    }
}
