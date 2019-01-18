@section('head:title', __('All Roles'))
@section('page:title', __('All Roles'))

@section('page:header')
  @parent
  <div class="btn-toolbar" role="toolbar">
    <div class="btn-group ml-2">
      <a role="button" href="{{ route('roles.create') }}" class="btn btn-primary">
        <i class="mdi mdi-shield-plus-outline"></i>&nbsp;
        {{ __('Add Role') }}
      </a>
    </div>
    <div class="btn-group ml-2">
      <div class="dropdown">
        <a href="#" class="btn btn-secondary" data-toggle="dropdown" aria-expanded="true">
          <i class="mdi mdi-settings"></i>
        </a>
        <div class="dropdown-menu mt-2 dropdown-menu-right dropdown-menu-arrow">
          <a data-toggle="collapse" data-target=".table-select" class="dropdown-item" href="#">
            <i class="dropdown-icon mdi mdi-playlist-edit"></i>
            <span>{{ __('Toggle Bulk Commands') }}</span>
          </a>
          <a data-modal-toggle data-toggle="modal" data-target="#import-confirmbox" class="dropdown-item" href="{{ route('profile.show', user()->username) }}">
            <i class="dropdown-icon mdi mdi-shield-plus"></i>
            <span>{{ __('Import Roles from Modules') }}</span>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('after:footer')
  @can('roles.create')
    @include('Theme::partials.modal', [
      'id' => 'import-confirmbox',
      'icon' => 'mdi mdi-shield-plus display-1 d-inline-block',
      'alignment' => 'text-left',
      'lead' => __('Importing Roles'),
      'method' => 'POST',
      'button' => __('Import from Modules'),
      'action' => route('roles.import'),
      'context' => 'primary',
      'include' => 'Role::fields.import',
    ])
  @endcan
@endpush

@include('Theme::admin.index', [
  'resources' => $resources,
  'actions' => ['search', 'show', 'destroy', 'trashed'],
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
      ['name' => 'name', 'link' => true], 'code', 'description', 'permission_count', 'created',
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
        'label' => __('Date Added'),
        'column' => 'created_at',
        'class' => '',
        'colspan' => 1,
        'sortable' => true,
      ],
    ]
  ],
])
