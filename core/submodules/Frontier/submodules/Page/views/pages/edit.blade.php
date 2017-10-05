@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <form action="{{ route('pages.update', $resource->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <v-layout row wrap>
                <v-flex md9>
                    <v-card class="mb-3 elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title>{{ __('New Page') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>
                            <v-text-field
                                name="title"
                                label="{{ __('Title') }}"
                                value="{{ $resource->title }}"
                            ></v-text-field>

                            <v-text-field
                                name="slug"
                                label="{{ __('Slug') }}"
                            ></v-text-field>
                        </v-card-text>

                        <input type="text" name="body">
                        <input type="text" name="delta">
                        <input type="text" name="feature">
                    </v-card>

                    @include("Theme::cards.editor")
                </v-flex>

                <v-flex md3>
                    @include("Theme::cards.saving")
                </v-flex>
            </v-layout>
        </form>
    </v-container>
@endsection
