@extends('Theme::layouts.admin')

@push('after:css')
  <link rel="stylesheet" href="{{ theme('dist/editor.min.css') }}">
  <script src="{{ theme('dist/editor.min.js') }}"></script>
@endpush

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <form action="{{ route('pages.store') }}" method="POST">
          @csrf

          @field('input', ['name' => 'title', 'attr' => 'data-slugger=[name=code]'])

          @field('input', ['name' => 'code', 'type' => 'hidden', 'label' => false])

          @field('editor', ['name' => 'body'])

          @field('select', [
            'key' => 'value',
            'text' => 'name',
            'attr' => 'data-selectpicker',
            'old' => old('template_id'),
            'name' => 'template_id',
            'label' => __('Template'),
            'items' => json_decode(json_encode(\Template\Models\Template::getTemplatesFromFiles())),
          ])

          @submit('Save')
        </form>

      </div>
    </div>
  </div>
@endsection
