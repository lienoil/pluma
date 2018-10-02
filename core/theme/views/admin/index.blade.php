@extends('Theme::layouts.admin')

@section('page-title')
  @parent
  @if (isset($buttons['primary']))
    <a role="button" href="{{ $buttons['primary']['url'] }}" class="btn btn-primary btn-lg">
      @isset ($buttons['primary']['icon'])
        <i class="{{ $buttons['primary']['icon'] }}"></i>&nbsp;
      @endisset
      {{ $buttons['primary']['text'] }}
    </a>
  @endif
@endsection

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        @if ($resources->items())
          <div class="card">
            <div class="card-header border-0">
              <div class="container-fluid p-0">
                <div class="row">
                  <div class="col-sm-12 col-lg-4">
                    @include('Theme::partials.search')
                  </div>
                  <div class="col-sm-12 col-lg my-2">
                    {{-- Bulk Commands --}}
                    <div class="btn-toolbar justify-content-lg-end justify-content-between" role="toolbar" aria-label="{{ __('Bulk Commands') }}">
                      <div class="btn-group btn-group-toggle" role="group" data-toggle="buttons">
                        <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target=".table-select"><i class="fe fe-check-square"></i></button>
                      </div>
                      @if (isset($actions) && $actions || ! isset($actions))
                        <div class="btn-group ml-3" role="group">
                          <button data-modal-toggle type="button" class="btn btn-secondary" disabled data-toggle="modal" data-target="#export-confirmbox" title="{{ __('Select users to export') }}">
                            <i class="fe fe-download-cloud"></i>
                          </button>
                          <button data-modal-toggle type="button" class="btn btn-secondary" disabled data-toggle="modal" data-target="#delete-confirmbox" title="{{ __('Select users to deactivate') }}">
                            <i class="fe fe-user-x"></i>
                          </button>
                        </div>
                      @endif

                      <div class="btn-group ml-3" role="group">
                        @include('Theme::partials.perpage')
                      </div>

                      <div class="btn-group ml-3" role="group">
                        <a role="button" href="{{ route('users.trashed') }}" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="{{ __('View deactivated users') }}">
                          <i class="fa fa-archive"></i>
                          <i class="fe fe-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                    {{-- Bulk Commands --}}
                  </div>
                </div>
              </div>
            </div>

            @if ($resources->lastPage() > 1)
              <header class="card-header justify-content-center border-0">
                @include('Theme::partials.pagination')
              </header>
            @endif

            <div class="table-responsive">
              <table data-with-selection class="table table-borderless card-table table-sm--disabled table-striped table-vcenter">
                <thead>
                  <tr>
                    <th class="table-select collapse">
                      <div class="custom-control custom-checkbox">
                        <input data-select-all="false" id="checkbox-all" type="checkbox" class="custom-control-input">
                        <label for="checkbox-all" class="custom-control-label"></label>
                      </div>
                    </th>

                    @foreach ($table['head'] as $i => $head)
                      <th colspan="{{ isset($head['colspan']) ? $head['colspan'] : null }}" class="{{ isset($head['class']) ? $head['class'] : null }}">
                        @if (isset($head['sortable']) && $head['sortable'])
                          @if (request()->get('sort') === $head['column'])
                            @switch (request()->get('order'))
                              @case('asc')
                                <a href="{{ route("{$text['plural']}.index", url_filter(['sort' => $head['column'], 'order' => 'desc'])) }}">{{ $head['label'] }} <i class="fa fa-sort-alpha-down"></i></a>
                                @break

                              @case('desc')
                                <a href="{{ route("{$text['plural']}.index", url_filter(['sort' => '', 'order' => ''])) }}">{{ $head['label'] }} <i class="fa fa-sort-alpha-up"></i></a>
                                @break

                              @default
                                <a href="{{ route("{$text['plural']}.index", url_filter(['sort' => $head['column'], 'order' => 'asc'])) }}">{{ $head['label'] }}</a>
                            @endswitch
                          @else
                            <a href="{{ route("{$text['plural']}.index", url_filter(['sort' => $head['column'], 'order' => 'asc'])) }}">{{ $head['label'] }}</a>
                          @endif
                        @else
                          <span>{{ $head['label'] }}</span>
                        @endif
                      </th>
                    @endforeach

                    @if (isset($actions) && $actions || ! isset($actions))
                      <th class="text-center">{{ __('Actions') }}</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach ($resources as $i => $resource)
                    <tr>
                      <td class="table-select collapse">
                        <div class="custom-control custom-checkbox">
                          <input data-select data-target=".bulk-data" id="checkbox-{{ $resource->id }}" type="checkbox" class="custom-control-input" value="{{ $resource->id }}" name="id[]">
                          <label for="checkbox-{{ $resource->id }}" class="custom-control-label"></label>
                        </div>
                      </td>

                      @foreach ($table['body'] as $body)
                        <td>{{ $resource->$body }}</td>
                      @endforeach

                      @if (isset($actions) && $actions || ! isset($actions))
                        <td class="text-center justify-content-center">
                          <a title="{{ __("Edit this {$text['singular']}") }}" href="{{ route("{$text['plural']}.edit", $resource->id) }}" role="button" class="btn btn-secondary btn-sm"><i class="fe fe-edit-2"></i></a>

                          <a title="{{ __("View this {$text['singular']}") }}" href="{{ route("{$text['plural']}.show", $resource->id) }}" role="button" class="btn btn-secondary btn-sm"><i class="fe fe-search"></i></a>

                          <form class="btn p-0 ml-1 form-row form-inline" action="{{ route("{$text['plural']}.destroy", $resource->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="id" value="{{ $resource->id }}">
                            <button title="{{ __("Move this {$text['singular']} to trash") }}" role="button" type="submit" class="btn btn-secondary btn-sm"><i class="fe fe-trash-2"></i></button>
                          </form>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <footer class="card-footer border-0 d-flex justify-content-center">
              @include('Theme::partials.pagination')
            </footer>
          </div>
          <footer class="p-1 pb-5 border-0 d-flex justify-content-center">
            @include('Theme::partials.pagestats')
          </footer>
        @endif

        @empty ($resources->items())
          <div class="p-5">
            @include('Theme::states.empty')
          </div>
        @endempty

      </div>
    </div>
  </div>
@endsection

@push('after-footer')
  {{-- Export --}}
  @if (isset($actions) && $actions || ! isset($actions))
    @include('Theme::partials.modal', [
      'id' => 'export-confirmbox',
      'icon' => 'fe fe-download-cloud display-1 icon-border icon-faded d-inline-block',
      'lead' => __('Select format to download.'),
      'text' => __('Export data to a specific file type.'),
      'method' => 'POST',
      'button' => __('Download'),
      'action' => route("{$text['plural']}.export"),
      'context' => 'primary',
      'include' => 'Theme::fields.export',
    ])

    {{-- Move to Trash --}}
    @include('Theme::partials.modal', [
      'id' => 'delete-confirmbox',
      'icon' => 'fe fe-trash display-1 icon-border icon-faded d-inline-block',
      'lead' => __("You are about to move to trash the selected {$text['plural']}."),
      'text' => 'To restore the data, got to the Trashed page. Are you sure yout want to continue?',
      'method' => 'DELETE',
      'action' => route("{$text['plural']}.destroy"),
      'button' => __('Move to trash'),
      'context' => 'warning',
    ])
  @endif
@endpush