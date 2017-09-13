<?php

namespace Library\Support\Mutators;

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
        return $this->guessThumbnailFromMimeType($this->mime, $this->url);
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

    /**
     * Guess the thumbnail of the library entry.
     *
     * @param  string $mime
     * @param  string $url
     * @return string
     */
    protected function guessThumbnailFromMimeType($mime, $url = false)
    {
        if ($mime !== config('thumbnails.accepted')) {
            switch ($mime) {
                case 'application/zip':
                case 'application/rar':
                    $archivePath = settings('library.extracted_files_path', 'public/archives');
                    $archive = storage_path("$archivePath/$this->name");
                    if (file_exists("$archive/thumbnail.png")) {
                        $url = url("storage/$archivePath/$this->name/thumbnail.png");
                    } else {
                        $url = "http://icons.iconarchive.com/icons/igh0zt/ios7-style-metro-ui/512/MetroUI-Other-ZIP-Archive-icon.png";
                    }
                    break;

                case null:
                default:
                    $url = url("storage/$url");
                    break;
            }
        }

        return $url;
    }
}
