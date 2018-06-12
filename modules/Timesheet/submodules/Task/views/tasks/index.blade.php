@extends("Theme::layouts.admin")

@section("main-content")

  @foreach ($resources as $task)
    <v-card>
      <v-card-title>
        {{ $task->name }}
      </v-card-title>
      <v-card-text>
        <p>{{ $task->body }}</p>
      </v-card-text>
      <v-card-actions>
        <v-btn flat href="{{ route('tasks.show', $task->id) }}">Show Detail</v-btn>
      </v-card-actions>
    </v-card>
  @endforeach
Collection
@endsection
