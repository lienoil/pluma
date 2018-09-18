@extends("Theme::layouts.admin")

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header justify-content-between">
            @include('Theme::partials.search')
            <div class="btn-toolbar" role="toolbar" aria-label="{{ __('Bulk Edit') }}">
              <div class="btn-group ml-3 btn-group-toggle" role="group" data-toggle="buttons">
                <button class="btn btn-secondary"><span class="fa fa-edit"></span></button>
                <button class="btn btn-secondary"><span class="fe fe-trash"></span></button>
              </div>
              <div class="btn-group ml-3" role="group">
                <a role="button" href="{{ route('roles.trashed') }}" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="{{ __('View deactivated resources') }}">
                  <i class="fa fa-archive"></i>
                  {{-- <span>{{ __('Deactivated') }}</span> --}}
                  <i class="fe fe-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
          @empty ($resources->items())
            <div class="card-body">
              @include('Theme::states.empty')
            </div>
          @endempty
          @if ($resources->items())
            @if ($resources->lastPage() > 1)
              <div class="card-header justify-content-end">
                @include('Theme::partials.pagination')
              </div>
            @endif
            <div class="table-responsive">
              <table class="table table-borderless card-table table-sm table-striped table-vcenter">
                <thead>
                  <tr>
                    <th colspan="2">{{ __('Account Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Date Created') }}</th>
                    <th class="text-center">{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($resources as $i => $resource)
                    <tr>
                      <td class="w-1">
                        <div class="d-flex">
                          <i class="{{ $resource->icon }}"></i>
                        </div>
                      </td>
                      <td>
                        <a title="{{ __('View details') }}" href="{{ route('roles.show', $resource->id) }}">
                          {{ $resource->name }}
                        </a>
                      </td>
                      <td>{{ $resource->email }}</td>
                      <td>{{ $resource->displayrole }}</td>
                      <td>{{ $resource->created }}</td>
                      <td class="text-center flex-row justify-content-center">
                        <a title="{{ __('Edit this resource') }}" href="{{ route('roles.edit', $resource->id) }}" role="button" class="btn btn-outline-secondary btn-sm"><i class="fe fe-edit-2"></i></a>

                        <form class="btn" action="{{ route('roles.destroy', $resource->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <input type="hidden" name="id" value="{{ $resource->id }}">
                          <button title="{{ __('Move this resource to trash') }}" role="button" type="submit" class="btn btn-outline-secondary btn-sm"><i class="fe fe-trash-2"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @if ($resources->lastPage() > 1)
              <footer class="card-footer d-flex justify-content-between">
                @include('Theme::partials.pagestats')
                @include('Theme::partials.pagination')
              </footer>
            @endif
          @endif
        </div>

      </div>
    </div>
  </div>
@endsection
