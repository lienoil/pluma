<?php

namespace Submission\Support\Traits;

use Crowfeather\Traverser\Traverser;
use Field\Models\Field;

trait SubmissionMutatorTrait
{
    /**
     * Array of choices.
     *
     * @var array
     */
    protected $choices;

    /**
     * Gets the user's displayname.
     *
     * @return string
     */
    public function getAuthorAttribute()
    {
        return ! $this->user ?: $this->user->displayname;
    }

    /**
     * Get the unserialized results column.
     *
     * @return array
     */
    public function getResultedAttribute()
    {
        return unserialize($this->results) ?? [];
    }

    /**
     * Collection of unserialized results with metadata.
     *
     * @return Object
     */
    public function fields()
    {
        $fields = [];
        foreach (collect($this->resulted)->except(['type']) as $name => $resulted) {
            $fields[$name]['question'] = $field = Field::find($resulted['field_id']);
            $fields[$name]['guess'] = $resulted[$name] ?? null;
            $fields[$name]['choices'] = $this->choices($field->value ?? '');
            $fields[$name]['answer'] = $this->getCorrectAnswer($field->value ?? '');
            $fields[$name]['points'] = $field->points;
            $fields[$name]['isCorrect'] = $this->isCorrect($field->value ?? '', $resulted[$name]);
        }

        return json_decode(json_encode($fields));
    }

    /**
     * Gets the array of choices.
     *
     * @param  string $string
     * @return array
     */
    public function choices($string)
    {
        $values = explode('|', $string);

        foreach ($values as $choice) {
            $choices[] = preg_replace('/\*/i', '', $choice);
        }

        return $choices ?? [];
    }

    /**
     * Gets the correct answer.
     *
     * @param  string $string
     * @return mixed
     */
    public function getCorrectAnswer($string)
    {
        $choices = explode('|', $string);

        foreach ($choices as $choice) {
            if (strpos($choice, '*')) {
                return preg_replace('/\*/i', '', $choice);
            }
        }

        return false;
    }

    /**
     * Checks if the given guess is correct.
     *
     * @param  string $value
     * @return boolean
     */
    public function isCorrect($value, $guess)
    {
        return $this->getCorrectAnswer($value) === $guess;
    }

    /**
     * Computes the score of resource.
     *
     * @return string
     */
    public function compute()
    {
        $fields = $this->fields();
        $score = [];
        foreach ($fields as $field) {
            if ($field->isCorrect) {
                $score[] = $field->points;
            }
        }

        return array_sum($score);
    }

    /**
     * Gets the mutated score column.
     *
     * @return string
     */
    public function getScoredAttribute()
    {
        return $this->score . "/" . count((array) $this->fields());
    }
}
