@field('input', [
  'label' => $label ?? false,
  'name' => $name,
  'icon' => $icon ?? null,
  'append' => $append ?? null,
  'prepend' => $prepend ?? null,
  'attr' => ($attr ?? null) . ' data-datepicker autocomplete=off',
  'class' => $class ?? null,
  'hint' => $hint ?? null,
  'value' => $value ?? null,
])
