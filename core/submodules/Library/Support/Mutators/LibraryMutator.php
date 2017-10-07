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
        return $this->guessThumbnailFromMimeType($this->mimetype, $this->url);
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
     * Gets the icon of the mimetype of the library resource.
     *
     * @return string
     */
    public function getIconAttribute()
    {
        return $this->guessIconFromMimeType($this->mimetype);
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
                    $archive = storage_path("$archivePath/$this->filename");
                    if (file_exists("$archive/thumbnail.png")) {
                        $url = url("storage/$archivePath/$this->filename/thumbnail.png");
                    } else {
                        // Brownish Monokai
                        $url = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAABlBMVEUhHRr////O/a2GAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAACklEQVQImWNgAAAAAgAB9HFkpgAAAABJRU5ErkJggg==";
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

    /**
     * Guess the icon of the library entry.
     *
     * @param  string $mime
     * @return string
     */
    protected function guessIconFromMimeType($mime)
    {
        $icon = 'perm_media';
        $icons = config('thumbnails.icons', []);
        if (array_key_exists($mime, $icons)) {
            $icon = $icons[$mime];
        }

        return $icon;
    }
}
