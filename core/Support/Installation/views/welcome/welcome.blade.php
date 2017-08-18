@extends("Install::layouts.installation")

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid>
        <v-layout row wrap>
            <v-flex sm12>
                <v-card class="mb-3">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="accent--text">{{ __($application->page->title) }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda hic dolores architecto perferendis. Eaque quos alias tempora repellendus aliquam doloremque reprehenderit numquam recusandae officiis est vero inventore modi cumque, repellat.
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
