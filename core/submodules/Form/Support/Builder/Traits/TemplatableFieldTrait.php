<?php

namespace Form\Support\Builder\Traits;

trait TemplatableFieldTrait
{
    /**
     * The template of the current field.
     *
     * @var string
     */
    protected $template;

    /**
     * The current field.
     *
     * @var stdClass
     */
    protected $field;

    /**
     * Retrieves the template for the given field.
     *
     * @return mixed
     */
    public function template(string $code, $templateFieldName = null)
    {
        if (! is_null($templateFieldName)) {
            $this->template = $this->items($code)->{$templateFieldName};
        } else {
            $this->template = $this->items($code)->fieldtype->template;
        }

        $this->field = $this->items($code);


        return $this;
    }

    /**
     * Render the current field's using the given template.
     *
     * @return html|string
     */
    public function render()
    {
        $template = $this->template;
        $template = preg_replace('/%name%/', $this->field->name, $template);
        $template = preg_replace('/%label%/', $this->field->label, $template);
        $template = preg_replace('/%tabindex%/', $this->field->sort ?? 0, $template);
        $template = preg_replace('/%type%/', $this->field->type ?? 'text', $template);
        $template = preg_replace('/%value%/', $this->field->value ?? '', $template);
        // $template = preg_replace('/%attributes%/', $this->field->attributed, $template);

        return $template;
    }
}
