@section('head:title', __('Trashed Pages'))
@section('page:title', __('Trashed Pages'))

@include('Theme::admin.trashed', [
  'resources' => $resources,
  'actions' => ['restore', 'delete', 'search'],
  'buttons' => [
    'primary' => [
      'icon' => 'mdi mdi-arrow-left',
      'text' => __('Back'),
      'class' => 'btn btn-link',
      'url' => route('pages.index'),
    ],
  ],
  'label' => [
    'singular' => __('Page'),
    'plural' => __('Pages'),
  ],
  'text' => [
    'singular' => 'page',
    'plural' => 'pages',
  ],
  'table' => [
    'body' => [
      ['name' => 'title', 'link' => true], 'code', 'author', 'removed',
    ],
    'head' => [
      [
        'label' => __('Title'),
        'column' => 'title',
        'colspan' => 1,
        'sortable' => true,
      ],
      [
        'label' => __('Code'),
        'column' => 'code',
        'class' => '',
        'colspan' => 1,
        'sortable' => true,
      ],
      [
        'label' => __('Author'),
        'column' => 'author',
        'class' => '',
        'colspan' => 1,
        'sortable' => false,
      ],
      [
        'label' => __('Date Removed'),
        'column' => 'deleted_at',
        'class' => '',
        'colspan' => 1,
        'sortable' => true,
      ],
    ]
  ],
])
