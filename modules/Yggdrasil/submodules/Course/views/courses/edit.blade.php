@extends("Theme::layouts.admin")

@section("content")
    <form action="{{ route('courses.update', $resource->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        {{ $resource->title }}
        <input type="text" name="title" value="{{ $resource->title }}">
        <button type="submit">Save</button>
    </form>
@endsection
