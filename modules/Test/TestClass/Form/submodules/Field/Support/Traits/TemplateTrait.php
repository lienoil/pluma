<?php

namespace Field\Support\Traits;

trait TemplateTrait
{
    /**
     * The template of the current field.
     *
     * @var string
     */
    protected $template;

    /**
     * Retrieves the template for the given field.
     *
     * @return mixed
     */
    public function template($code, $templateFieldName = null)
    {
        if (! is_null($templateFieldName)) {
            $this->template = $this->{$templateFieldName};
        } else {
            $this->template = $this->fieldtype->template;
        }

        if (is_null($this->template)) {
            $this->template = $this->getDefaultTemplate();
        }

        return $this;
    }

    /**
     * HTML render of a default input field.
     *
     * @return string
     */
    public function getDefaultTemplate()
    {
        return '<input type="%type%" name="%name%" placeholder="%label%" %attributes%>';
    }

    /**
     * Render the current field's using the given template.
     *
     * @return html|string
     */
    public function render()
    {
        $template = $this->template;
        $template = preg_replace('/%name%/', $this->name, $template);
        $template = preg_replace('/%label%/', $this->label, $template);
        $template = preg_replace('/%tabindex%/', $this->sort, $template);
        $template = preg_replace('/%type%/', $this->type, $template);
        $template = preg_replace('/%value%/', $this->value, $template);
        $template = preg_replace('/%attributes%/', $this->attributed, $template);

        return $template;
    }

    /**
     * Mutates the column `attributes` into a string.
     *
     * @return string
     */
    public function getAttributedAttribute()
    {
        $attributes = array_filter(array_map('trim', explode(PHP_EOL, $this->attributes)));

        foreach ($attributes as &$attribute) {
            $attribute = explode('=', $attribute)[0]
                            . "="
                            . '"'
                            . str_replace(
                                ['"', "'"],
                                '',
                                trim(explode('=', $attribute)[1] ?? '')
                              )
                            . '"';
        }

        return implode(' ', $attributes);
    }
}
