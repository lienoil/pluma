<?php

namespace Content\Support\Traits;

use Course\Models\Scormvar;
use Course\Models\Status;
use Form\Models\Form;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
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
     * Gets the next content via sort order.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNextAttribute()
    {
        $sort = $this->sort;
        $contents = $this->course->contents;

        $next = null;
        foreach ($contents as $i => $content) {
            if ($content->sort == $sort) {
                if (isset($contents[$i+1])) {
                    return $contents[$i+1]->url ?? false;
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
        $contents = $this->course->contents()->orderBy('sort', 'ASC')->get();

        $next = null;
        foreach ($contents as $i => $content) {
            if ($content->sort == $sort) {
                if (isset($contents[$i-1])) {
                    return $contents[$i-1]->url ?? false;
                }
            }
        }

        return false;
    }

    /**
     * Gets the currently playing url from playlist.
     *
     * @return string
     */
    public function getPlayingAttribute()
    {
        $content_id = collect($this->lesson->playlist)
                            ->where('status', 'current')
                            ->first()
                            ->content_id ?? null;
        return $content_id ? $this->find($content_id)->url : false;
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
     * Gets the Interactive file.
     *
     * @return mixed
     */
    public function getInteractiveAttribute()
    {
        $entrypoint = "";
        try {
            if ($this->library) {
                switch ($this->library->mimetype) {
                    case 'application/zip':
                    case 'application/rar':
                    case 'application/x-zip-compressed':
                    case 'application/x-rar-compressed':
                    case 'application/*':
                        $date = date('Y-m-d', strtotime($this->library->created_at));
                        $path = settings('package.storage_path', 'public/package') . "/$date/{$this->library->id}";

                        if (file_exists(storage_path("$path/imsmanifest.xml"))) {
                            $xml = $this->imsmanifest;
                            $entrypoint = isset($xml->resources->resource['href'])
                                            // ? utf8_decode(urldecode($xml->resources->resource['href']))
                                            ? urlencode($xml->resources->resource['href'])
                                            : 'index.html';

                            $entrypoint = url("storage/$path/$entrypoint");
                        } elseif (file_exists(storage_path("$path/multiscreen.html"))) {
                            $entrypoint = url("storage/$path/multiscreen.html");
                        } else {
                            $entrypoint = url("storage/$path/index.html");
                        }
                        break;

                    case 'video/ogg':
                    case 'video/mp4':
                    case 'video/wmv':
                    default:
                        $entrypoint = url("storage/{$this->library->url}");
                        break;
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $entrypoint;
    }

    /**
     * Try to get the imsmanifest.xml file as a
     * SimpleXMLElement.
     *
     * @return mixed
     */
    public function getImsmanifestAttribute()
    {
        $imsmanifest = false;

        try {
            if ($this->library) {
                $date = date('Y-m-d', strtotime($this->library->created_at));
                $path = settings('package.storage_path', 'public/package') . "/$date/{$this->library->id}";

                if (file_exists(storage_path("$path/imsmanifest.xml"))) {
                    $xml = File::get(storage_path("$path/imsmanifest.xml"));
                    $imsmanifest = new SimpleXMLElement($xml);
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $imsmanifest;
    }

    /**
     * Returns the interactive content with
     * appropriate HTML tags.
     *
     * @return string
     */
    public function getHtmlAttribute()
    {
        $interactive = urldecode($this->interactive); // $interactive = $this->interactive;
        // $html = "No Data";

        if (! is_null($this->contentable_id) && ! is_null($this->contentable_type)) {
            switch ($this->contentable_type) {
                case 'Form\Models\Form':
                default:
                    $type = $this->type;
                    $interactive = $this->interactive;
                    $html = view("Content::partials.form")->with([
                        'type' => $type,
                        'interactive' => $interactive,
                        'resource' => Form::find($this->contentable->id)
                    ])->render();
                    break;
            }
        } elseif ($this->library) {

            switch ($this->library->mimetype) {
                case 'application/zip':
                case 'application/rar':
                case 'application/x-zip-compressed':
                case 'application/x-rar-compressed':
                case 'application/*':
                    $html = "<object data-type='{$this->type}' data={$interactive} class='interactive-content' onunload=window.API.LMSFinish('') onbeforeunload=window.API.LMSFinish('')>
                                <param name='src' value={$interactive}>
                                <param name='autoplay' value=false>
                                <param name='autoStart' value=0>
                                <embed src={$interactive}>
                            </object>";
                    break;

                case 'video/ogg':
                case 'video/mp4':
                case 'video/wmv':
                    $html = "<video data-type='{$this->type}' class='interactive-content' autobuffer autoplay controls width='100%' onunload=window.API.LMSFinish('') onbeforeunload=window.API.LMSFinish('')>
                                <source src='{$interactive}'>
                                <source src='{$interactive}'>
                                <object type='{$this->library->mimetype}' data='{$interactive}'>
                                    <param name='src' value='{$interactive}'>
                                    <param name='autoplay' value='false'>
                                    <param name='autoStart' value='0'>
                                </object>
                            </video>";
                    break;

                default:
                    $html = "<object data-type='{$this->type}' class='interactive-content' data={$interactive} width=100% height=auto onunload=window.API.LMSFinish('') onbeforeunload=window.API.LMSFinish('')>
                                <param name='src' value={$interactive}>
                                <param name='autoplay' value=false>
                                <param name='autoStart' value=0>
                                <embed type='{$this->library->mimetype}' src={$interactive}>
                            </object>";
                    break;
            }
        }

        return $html;
    }

    /**
     * Get the SCORM version.
     *
     * @return string
     */
    public function getVersionAttribute()
    {
        if ($this->imsmanifest) {
            if ($this->imsmanifest->metadata->schemaversion) {
                return $this->imsmanifest->metadata->schemaversion;
            } elseif ($this->imsmanifest->attributes()->version) {
                return $this->imsmanifest->attributes()->version;
            }

            return "";
        }

        return null;
    }

    /**
     * Gets the mutated status column from course_user's pivot column.
     *
     * @return boolean
     */
    public function getCompletedAttribute()
    {
        $entry = collect($this->lesson->playlist)->where('content_id', $this->id)->first();

        return ($entry->status ?? false) === "done" || ($entry->status ?? false) === "previous";
    }

    /**
     * Gets the mutated status column from course_user's pivot column.
     *
     * @return boolean
     */
    public function getCurrentAttribute()
    {
        $entry = collect($this->lesson->playlist)->where('content_id', $this->id)->first();

        return ($entry->status ?? false) === "current";
    }

    /**
     * Gets the mutated status column from course_user's pivot column.
     *
     * @return boolean
     */
    public function getLockedAttribute()
    {
        $entry = collect($this->lesson->playlist)->where('content_id', $this->id)->first();

        return ($entry->status ?? false) === "pending";
    }

    /**
     * Gets the mutated status column from course_user's pivot column.
     *
     * @return boolean
     */
    public function getIncompleteAttribute()
    {
        $entry = collect($this->lesson->playlist)->where('content_id', $this->id)->first();

        return ($entry->status ?? false) === "incomplete" || ($entry->status ?? false) === "current";
    }

    /**
     * Gets the status from comparing current url to resource's own url.
     *
     * @return boolean
     */
    public function getActiveAttribute()
    {
        return $this->url == Request::url();
    }

    /**
     * Gets the library mimetype of the resource.
     *
     * @return string
     */
    public function getTypeAttribute()
    {
        return $this->library->mimetype ?? '';
    }

    /**
     * Check if interactive media is form.
     *
     * @return boolean
     */
    public function isForm()
    {
        return $this->contentable_type === "Form\Models\Form";
    }

    /**
     * Check if form has been answered.
     *
     * @return boolean
     */
    public function isFormFinished()
    {
        if (! user()) {
            return false;
        }

        $form = Form::find($this->contentable_id);

        if (! $form->exists()) {
            return false;
        }

        return $form->submissions()->where('user_id', user()->id)->exists();
    }
}
