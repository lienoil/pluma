@section('head:title', __('Trashed Roles'))
@section('page:title', __('Trashed Roles'))

@include('Theme::admin.trashed', [
  'resources' => $resources,
  'actions' => ['restore', 'delete', 'search'],
  'buttons' => [
    'primary' => [
      'icon' => 'mdi mdi-arrow-left',
      'text' => __('Back'),
      'class' => 'btn btn-link',
      'url' => route('roles.index'),
    ],
  ],
  'label' => [
    'singular' => __('Role'),
    'plural' => __('Roles'),
  ],
  'text' => [
    'singular' => 'role',
    'plural' => 'roles',
  ],
  'table' => [
    'body' => [
      'name', 'code', 'description', 'permission_count', 'removed',
    ],
    'head' => [
      [
        'label' => __('Name'),
        'column' => 'name',
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
        'label' => __('Description'),
        'column' => 'description',
        'class' => '',
        'colspan' => 1,
        'sortable' => false,
      ],
      [
        'label' => __('Permissions'),
        'column' => 'permission_count',
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
