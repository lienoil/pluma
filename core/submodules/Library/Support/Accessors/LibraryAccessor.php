<?php

namespace Library\Support\Accessors;

trait LibraryAccessor
{
    /**
     * Access the url of the resource.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return url("storage/{$this->uri}");
    }

    /**
     * Gets the thumbnail of the library resource.
     *
     * @return string
     */
    public function getPreviewAttribute()
    {
        return $this->guessThumbnailFromMimeType($this->mimetype, $this->thumbnail);
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
                case 'application/x-zip-compressed':
                case 'application/x-rar-compressed':
                    $archivePath = settings('package.storage_path', 'public/package').'/'.date('Y-m-d', strtotime($this->created_at))."/{$this->id}";
                    if (file_exists(storage_path("$archivePath/thumbnail.png"))) {
                        $url = url("storage/$archivePath/thumbnail.png");
                    } else {
                        // Brownish Monokai
                        $url = config("thumbnails.thumbnails.$mime");
                    }
                    break;

                case 'audio/mpeg':
                case 'audio/mp3':
                    $url = config("thumbnails.thumbnails.$mime");
                    break;

                case 'video/*':
                case 'video/ogv':
                case 'video/ogg':
                case 'video/wmv':
                case 'video/mp4':
                    $url = config("thumbnails.thumbnails.video/mp4");
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
