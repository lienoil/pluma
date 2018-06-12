@extends("Theme::layouts.admin")

@section("main-content")
  <v-container>
    <v-layout row wrap>
      <v-flex xs12>
        <v-card>
          <v-card-title>
            {{ $resource->dated }}
          </v-card-title>
          <v-card-text>
            <p class="body-2"><strong>Tasks</strong></p>
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

