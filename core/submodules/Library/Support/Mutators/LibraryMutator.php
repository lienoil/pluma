<?php

namespace Library\Support\Mutators;

use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\File;
use Parchment\Helpers\Word;

trait LibraryMutator
{
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

    /**
     * Check if mimetype of file is extractable.
     *
     * @param  string  $mimetype
     * @return boolean
     */
    public static function isExtractable($mimetype)
    {
        $extractables = config("extractables", []);
        if (in_array($mimetype, $extractables)) {
            return true;
        }

        return false;
    }

    /**
     * Extracts file on a given path.
     *
     * @param  string $path
     * @param  string $outputPath
     * @return void
     */
    public static function extract($path, $outputPath)
    {
        try {
            if (File::exists($path)) {
                $zipper = new Zipper;

                if (! file_exists($outputPath)) {
                    File::makeDirectory($outputPath, $mode = 0777, true, true);
                }
                $zipper->zip($path)->extractTo($outputPath);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return true;
    }
}
