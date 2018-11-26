@php
  $title = $title ?? 'title';
  $url = $url ?? 'url';
  $code = $code ?? 'code';
@endphp

<ol data-dragdrop data-dragdrop-options="{{ json_encode($options ?? '{}') }}" class="dragdrop vertical">
  @field('dragdrop-item', [
    'items' => $items,
    'title' => $title,
    'url' => $url,
    'code' => $code,
    'parent' => $parent ?? null,
    'options' => $options ?? null
  ])
</ol>
