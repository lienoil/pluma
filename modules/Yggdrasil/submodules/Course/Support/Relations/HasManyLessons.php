<?php

namespace Course\Support\Relations;

use Course\Models\Lesson;

trait HasManyLessons
{
    /**
     * Gets the resources that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function getChildrenAttribute()
    {
        $lessons = $this->lessons->pluck('id');
        $lessons = implode(',', $lessons->toArray());

        $query = "
            SELECT d.*, p.ancestor_id AS _parent
                FROM lessonstree AS c
                INNER JOIN lessons AS d ON c.descendant_id = d.id
                LEFT JOIN lessonstree AS p ON p.descendant_id = d.id
                    AND p.ancestor_id IN ($lessons)
                    AND p.depth = 1
                WHERE (c.ancestor_id = 1)
                    AND (p.ancestor_id IS NOT NULL OR d.id = 1)
                ORDER BY c.depth, d.title
        ";
        return \Illuminate\Support\Facades\DB::select($query);
        return $this->lessons()->where();
    }
}
