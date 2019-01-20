@field('input', [
  'label' => $label ?? false,
  'name' => $name,
  'icon' => $icon ?? null,
  'append' => $append ?? null,
  'prepend' => $prepend ?? null,
  'attr' => ($attr ?? null) . ' data-timepicker autocomplete=off',
  'class' => $class ?? null,
])
