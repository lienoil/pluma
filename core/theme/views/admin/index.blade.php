@extends('Theme::layouts.admin')

@section('page:header')
  @parent
  @if (isset($buttons['primary']))
    <a role="button" href="{{ $buttons['primary']['url'] }}" class="{{ $buttons['primary']['class'] ?? 'btn btn-primary' }}">
      @isset ($buttons['primary']['icon'])
        <i class="{{ $buttons['primary']['icon'] }}"></i>&nbsp;
      @endisset
      {{ @$buttons['primary']['text'] }}
    </a>
  @endif
@endsection

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        @if ($resources->items())
          <div class="card">
            <div class="card-header border-0">
              <div class="container-fluid p-0">
                <div class="row">

                  @if (isset($actions) && in_array('search', $actions))
                    <div class="col-sm-12 col-lg-4">
                      @include('Theme::partials.search')
                    </div>
                  @endif

                  <div class="col-sm-12 col-lg my-2">
                    {{-- Bulk Commands --}}
                    <div class="btn-toolbar justify-content-lg-end justify-content-between" role="toolbar" aria-label="{{ __('Bulk Commands') }}">

                      @if (isset($actions) && $actions)
                        <div class="btn-group btn-group-toggle" role="group" data-toggle="buttons">
                          <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target=".table-select"><i class="mdi mdi-checkbox-marked-circle"></i></button>
                        </div>

                        <div class="btn-group ml-3" role="group">
                          @if (in_array('export', $actions ?? []))
                            <button data-modal-toggle type="button" class="btn btn-secondary" disabled data-toggle="modal" data-target="#export-confirmbox" title="{{ __('Select '.$text['plural'].' to export') }}">
                              <i class="mdi mdi-download"></i>
                            </button>
                          @endif

                          @if (in_array('destroy', $actions ?? []))
                            <button data-modal-toggle type="button" class="btn btn-secondary" disabled data-toggle="modal" data-target="#delete-confirmbox" title="{{ __('Select '.$text['plural'].' to deactivate') }}">
                              <i class="mdi mdi-delete-outline"></i>
                            </button>
                          @endif
                        </div>
                      @endif

                      <div class="btn-group ml-3" role="group">
                        @include('Theme::partials.perpage')
                      </div>

                      @if (in_array('trashed', $actions ?? []))
                        <div class="btn-group ml-3" role="group">
                          <a role="button" href="{{ route($text['plural'].'.trashed') }}" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="{{ __('View archived '.$text['plural']) }}">
                            <i class="mdi mdi-delete-empty"></i>
                            <i class="mdi mdi-arrow-right"></i>
                          </a>
                        </div>
                      @endif
                    </div>
                    {{-- Bulk Commands --}}
                  </div>
                </div>
              </div>
            </div>

            @if ($resources->lastPage() > 1)
              <header class="card-header text-center ox-auto border-0">
                <div class="mx-auto">@include('Theme::partials.pagination')</div>
              </header>
            @endif

            <div class="table-responsive">
              <table data-with-selection class="table table-borderless card-table table-striped table-vcenter">
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
                                <a href="{{ route("{$text['plural']}.index", url_filter(['sort' => $head['column'], 'order' => 'desc'])) }}">{{ $head['label'] }} <i class="mdi mdi-sort-descending"></i></a>
                                @break

                              @case('desc')
                                <a href="{{ route("{$text['plural']}.index", url_filter(['sort' => '', 'order' => ''])) }}">{{ $head['label'] }} <i class="mdi mdi-sort-ascending"></i></a>
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

                    @if ((isset($actions) && $actions) || ! isset($actions))
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
                        <td>
                          @if (is_array($body))
                            @if ($body['link'] ?? false)
                              @can($resource->getTable().'.edit')
                                <a title="{{ __('Edit:') }} {{ $resource->{$body['name']} }}" href="{{ route($resource->getTable().'.edit', $resource->id) }}">{{ $resource->{$body['name']} }}</a>
                              @else
                                <span title="{{ __('You are not allowed to edit this resource.') }}">{{ $resource->{$body['name']} }}</span>
                              @endcan
                            @endif
                          @else
                            {{ $resource->$body }}
                          @endif
                        </td>
                      @endforeach

                      @if ((isset($actions) && $actions) || ! isset($actions))
                        <td class="text-center justify-content-center d-flex">
                          @if (in_array('edit', $actions ?? []))
                            @can($resource->getTable().'.edit')
                              <a title="{{ __("Edit this {$text['singular']}") }}" href="{{ route("{$text['plural']}.edit", $resource->id) }}" role="button" class="mx-1 btn btn-icon btn-sm"><i class="mdi mdi-pencil-outline"></i></a>
                            @endcan
                          @endif

                          @can($resource->getTable().'.show', $resource)
                            <a title="{{ __("View this {$text['singular']}") }}" href="{{ route("{$text['plural']}.show", $resource->id) }}" role="button" class="mx-1 btn btn-icon btn-sm"><i class="mdi mdi-eye"></i></a>
                          @endcan

                          <form class="d-block mx-1" action="{{ route("{$text['plural']}.destroy", $resource->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="id" value="{{ $resource->id }}">
                            <button title="{{ __("Move this {$text['singular']} to trash") }}" role="button" type="submit" class="btn btn-icon btn-sm"><i class="mdi mdi-delete-outline"></i></button>
                          </form>
                        </td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <footer class="card-footer ox-auto border-0 d-flex text-center">
              <div class="mx-auto">@include('Theme::partials.pagination')</div>
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

@if ((isset($actions) && $actions) || ! isset($actions))
  @push('after:footer')
    @if (in_array('export', $actions ?? []))
      {{-- Export --}}
      @include('Theme::partials.modal', [
        'id' => 'export-confirmbox',
        'icon' => 'mdi mdi-download display-1 icon-faded d-inline-block',
        'lead' => __('Select format to download.'),
        'text' => __('Export data to a specific file type.'),
        'method' => 'POST',
        'button' => __('Download'),
        'action' => route("{$text['plural']}.export"),
        'context' => 'primary',
        'include' => 'Theme::fields.export',
      ])
    @endif

    @if (in_array('destroy', $actions ?? []))
      {{-- Move to Trash --}}
      @include('Theme::partials.modal', [
        'id' => 'delete-confirmbox',
        'icon' => 'mdi mdi-delete-outline display-1 icon-faded d-inline-block',
        'lead' => __("You are about to move to trash the selected {$text['plural']}."),
        'text' => 'To restore the data, got to the Trashed page. Are you sure yout want to continue?',
        'method' => 'DELETE',
        'action' => route("{$text['plural']}.destroy"),
        'button' => __('Move to trash'),
        'context' => 'warning',
      ])
    @endif
  @endpush
@endif
