<?php

namespace User\Support\Accessors;

use DateTime;

trait DetailAccessor
{
    /**
     * Retrieve the mutated key value.
     *
     * @return string
     */
    public function getKeywordAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->key));
    }

    /**
     * Format the given value.
     *
     * @return string
     */
    public function getTextAttribute()
    {
        # Filter if valid date
        if (DateTime::createFromFormat('m/d/Y', $this->value) !== false) {
            return date(settings('date_format'), strtotime($this->value));
        }

        # Filter if valid url
        if (count(parse_url($this->value)) > 1) {
            return '<a target=_blank href='.$this->value.'>'.$this->value.'</a>';
        }

        return $this->value;
    }
}
