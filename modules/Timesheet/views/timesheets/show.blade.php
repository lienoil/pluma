@extends("Theme::layouts.admin")

@section("main-content")
  <v-container>
    <v-layout row wrap>
      <v-flex xs12>
        <v-card>
          <v-card-title>
            {{ $resource->dayname }}
          </v-card-title>
          <v-card-text>
            @foreach ($resource->tasks as $task)
              <p>{{ $task->name }}</p>
              <p>{{ $task->body }}</p>
            @endforeach
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
@endsection

