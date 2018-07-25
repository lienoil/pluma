<?php

namespace Library\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Library extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'catalogue' => [
                'id' => $this->catalogue ? $this->catalogue->id : null,
                'name' => $this->catalogue ? $this->catalogue->name : null,
            ],
            'description' => $this->description,
            'filename' => $this->filename,
            'filesize' => $this->filesize,
            'mimetype' => $this->mimetype,
            'name' => $this->name,
            'originalname' => $this->originalname,
            'thumbnail' => $this->thumbnail,
            'type' => $this->type,
            'url' => $this->url,
            'created' => $this->created,
            'modified' => $this->modified,
            'deleted' => $this->deleted,
        ];
    }
}
