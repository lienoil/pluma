@extends("Theme::layouts.admin")

@section("main-content")
  <div class="ml-2">
    {{ __('All Courses') }}
  </div>
  @foreach ($resources as $course)
    <div>
      <a class="ml-4" href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
    </div>
  @endforeach
@endsection
