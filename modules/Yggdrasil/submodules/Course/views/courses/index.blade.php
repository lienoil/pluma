@extends("Theme::layouts.admin")

@section("main-content")
  {{ __('All Courses') }}
  @foreach ($resources as $course)
    <div>
      <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
    </div>
  @endforeach
@endsection
