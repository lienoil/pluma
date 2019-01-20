
@field('input', [
  'label' => $label ?? $name ?? false,
  'name' => $name,
  'icon' => $icon ?? null,
  'append' => $append ?? null,
  'prepend' => $prepend ?? null,
  'attr' => ($attr ?? null) . ' data-daterangepicker autocomplete=off',
  'class' => $class ?? null,
])
