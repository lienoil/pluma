<?php

namespace Library\Supports\Mutators;

use Parchment\Helpers\Word;

trait LibraryMutator
{
    /**
     * Gets the thumbnail of the library resource.
     *
     * @return string
     */
    public function getThumbnailAttribute()
    {
        $url = $this->url;
        return url("storage/$url");
    }

    /**
     * Gets the human readable size of the library resource.
     *
     * @return string
     */
    public function getFilesizeAttribute()
    {
        return Word::bytes($this->size);
    }
}
