@extends("Frontier::layouts.admin")

@section("head-title", __('Roles'))
@section("page-title", __('Roles'))

@section("content")
    <div class="container">
        <div class="">
            <h3 class="page--title">{{ $application->page->title }}</h3>
        </div>
    </div>
@endsection
