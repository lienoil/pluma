@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @foreach ($resources as $resource)
            <form action="{{ route('quests.destroy') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p>{{ $resource->title }}</p>
                <input type="hidden" name="id" value="{{ $resource->id }}">
                <v-btn type="submit">Delete</v-btn>
            </form>
        @endforeach

        <form action="{{ route('quests.destroy') }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            @foreach ($resources as $resource)
                <input type="text" name="id[]" value="{{ $resource->id }}">
            @endforeach
            <v-btn type="submit">Delete All</v-btn>
        </form>
    </v-container>
@endsection
