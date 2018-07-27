<?php

namespace Course\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Lesson extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'code' => $this->code,
            'feature' => $this->feature,
            'backdrop' => $this->backdrop,
            'body' => $this->body,
        ];
    }
}
