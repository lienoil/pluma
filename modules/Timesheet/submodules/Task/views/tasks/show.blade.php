@extends("Theme::layouts.admin")

@section("main-content")

    <v-card>
      <v-card-title>
        {{ $resource->name }}
      </v-card-title>
      @foreach ($resource->timesheets as $timesheet)
      <v-card-text>
        <p>{{ $timesheet->dayname }}</p>
        <p>{{ $timesheet->date }}</p>
        <p>{{ $timesheet->in }}</p>
        <p>{{ $timesheet->timeout }}</p>
      </v-card-text>
      <v-card-actions>
    </v-card>
  @endforeach
@endsection
