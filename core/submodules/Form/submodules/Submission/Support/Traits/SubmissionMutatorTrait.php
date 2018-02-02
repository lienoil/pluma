<?php

namespace Submission\Support\Traits;

use Crowfeather\Traverser\Traverser;
use Field\Models\Field;

trait SubmissionMutatorTrait
{
    /**
     * Gets the user's displayname.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return ! $this->user ?: $this->user->displayname;
    }

    public function getResultedAttribute()
    {
        return unserialize($this->results);
    }

    public function fields()
    {
        $fields = [];
        foreach (collect($this->resulted)->except(['type']) as $name => $resulted) {
            $fields['question'] = Field::find($resulted['field_id']);
            $fields['answer'] = $resulted[$name];
        }

        return json_decode(json_encode($fields));
    }
}
