@extends("Test::layouts.admin")

@section("content")

    <index :module="tests" :url="{index: '{{ route('api.pages.all') }}'}"></index>
    ads

@endsection
