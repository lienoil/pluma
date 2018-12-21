@section('head:title', __('All Pages'))
@section('page:title', __('All Pages'))

@include('Theme::admin.index', [
  'resources' => $resources,
  'actions' => ['search', 'show', 'destroy', 'delete', 'trashed'],
  'buttons' => [
    'primary' => [
      'icon' => 'mdi mdi-plus',
      'text' => __('New Page'),
      'url' => route('pages.create'),
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
      ['name' => 'title', 'link' => true], 'code', 'author', 'created',
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
        'label' => __('Date Added'),
        'column' => 'created_at',
        'class' => '',
        'colspan' => 1,
        'sortable' => true,
      ],
    ]
  ],
])
