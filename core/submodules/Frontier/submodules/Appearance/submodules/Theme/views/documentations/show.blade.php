@extends('Theme::layouts.settings')

@section('head:title', __('Theme: ').$resource->name)
@section('page:title', __('Theme: ').$resource->name)

@push('after:css')
  <link rel="stylesheet" href="{{ url('anytheme/'.$resource->code.'/dist/app.min.css') }}">
@endpush

@section('main:sidebar')
  @include('Theme::partials.docmenus')
  <div data-sticky="#themes-components-table-of-contents"></div>
  <div id="themes-components-table-of-contents" data-sticky-class="sticky">
    <hr>
    <p class="small">{{ __('Table of Contents') }}</p>
    <div id="themes-components-table-of-contents-list" class="small list-group-unstyled">{!! $content->toc->toHtml() !!}</div>
    <a href="#top" class="small"><i class="mdi mdi-arrow-up">&nbsp;</i>{{ __('Back to top') }}</a>
  </div>
@endsection

@section('page:content')
  <div data-spy="scroll" data-target="#themes-components-table-of-contents-list" data-offset="0">
    <a name="top"></a>
    <div id="component-card">{!! $content->toHtml() !!}</div>
    <a href="#top">{{ __('Back to top') }}</a>
  </div>
@endsection
