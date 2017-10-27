<?php

namespace Content\Support\Traits;

use Illuminate\Support\Facades\File;
use SimpleXMLElement;

trait ContentMutator
{
    /**
     * Route show shortcut.
     *
     * @return \Illuminate\Routing\Route
     */
    public function getUrlAttribute()
    {
        return route('contents.show', [$this->lesson->course->slug, $this->lesson->id, $this->id]);
    }

    /**
     * Alias for unlock.
     *
     * @return boolean
     */
    public function getCompletedAttribute()
    {
        return $this->unlocked;
    }

    /**
     * Gets the next content via sort order.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNextAttribute()
    {
        $sort = $this->sort;
        $contents = $this->lesson->contents()->orderBy('sort', 'ASC')->get();

        $next = null;
        foreach ($contents as $i => $content) {
            if ($content->sort == $sort) {
                if (isset($contents[$i+1])) {
                    return $contents[$i+1];
                }
            }
        }

        return false;
    }

    /**
     * Gets the next content via sort order.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getPreviousAttribute()
    {
        $sort = $this->sort;
        $contents = $this->lesson->contents()->orderBy('sort', 'ASC')->get();

        $next = null;
        foreach ($contents as $i => $content) {
            if ($content->sort == $sort) {
                if (isset($contents[$i-1])) {
                    return $contents[$i-1];
                }
            }
        }

        return false;
    }

    /**
     * Gets the current order of the resource.
     *
     * @return integer
     */
    public function getOrderAttribute()
    {
        return (int) $this->sort+1;
    }

    /**
     * Check if content has already been started before.
     *
     * @return boolean
     */
    public function getStartedAttribute()
    {
        return false;
    }

    /**
     * Gets the Interactive file.
     *
     * @return mixed
     */
    public function getInteractiveAttribute()
    {
        $entrypoint = "";
        try {
            $date = date('Y-m-d', strtotime($this->library->created_at));
            $path = settings('package.storage_path', 'public/package') . "/$date/{$this->library->id}";

            if (file_exists(storage_path("$path/imsmanifest.xml"))) {
                $xml = File::get(storage_path("$path/imsmanifest.xml"));
                $xml = new SimpleXMLElement($xml);
                $entrypoint = isset($xml->resources->resource['href'])
                                ? $xml->resources->resource['href']
                                : 'index.html';

                $entrypoint = url("storage/$path/$entrypoint");
            } elseif (file_exists(storage_path("$path/multiscreen.html"))) {
                $entrypoint = url("storage/$path/multiscreen.html");
            } else {
                $entrypoint = url("storage/$path/index.html");
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $entrypoint;
    }
}
