<?php

namespace Fieldtype\Support\Relations;

use Fieldtype\Models\Fieldtype;
use User\Models\User;

trait BelongsToFieldtype
{
    /**
     * Gets the model this resource belongs to.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function fieldtype()
    {
        return $this->belongsTo(Fieldtype::class);
    }
}
