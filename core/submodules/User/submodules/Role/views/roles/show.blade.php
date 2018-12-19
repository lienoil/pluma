@extends('Theme::layouts.admin')

@section('head:title', $resource->name)
@section('page:title', $resource->name)

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <p>{!! $resource->description !!}</p>

        <div class="row">
          <div class="col-sm-12 col-lg-4">
            <div class="card">
              <div class="card-body">
                @include('Theme::fields.treeview', [
                  'label' => __('Permissions'),
                  'actions' => false,
                  'readonly' => true,
                  'icon' => 'mdi mdi-shield-half-full text-green',
                  'items' => $resource->permissions->groupBy('group'),
                  'key' => 'code',
                  'text' => 'description',
                ])
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
