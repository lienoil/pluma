@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar dark class="teal darken-1 elevation-1">
        <v-toolbar-title>{{ __("{$user->nickname}'s Timesheets") }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid>
        <v-layout row wrap fill-height>
            <v-flex md6 offset-md3 sm12 xs12>
                @if ($resources->isEmpty())
                    <v-card class="grey lighten-4 elevation-1">
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <img class="text-xs-center" src="{{ assets('timesheet/images/icon-hourly.gif') }}" alt="{{ __('No Timesheets found.') }}">
                            <v-spacer></v-spacer>
                        </v-card-actions>
                        <v-card-text class="grey--text text--darken-1 text-xs-center">{{ __('No Monthly Timesheets to display.') }}</v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn class="teal white--text elevation-1" href="{{ route('timesheets.create') }}">{{ __('Create Timesheet') }}</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                @endif

                @foreach ($resources as $resource)
                    <v-card class="mb-3 grey--text text--darken-2 elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title primary-title class="teal--text text--darken-2">{{ $resource->name }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-chip label class="teal white--text"><v-icon left class="white--text">label_outline</v-icon>{{ $resource->code }}</v-chip>
                        </v-toolbar>
                        <v-list>
                            <v-list-tile>
                                <v-list-tile-avatar>
                                    <v-icon class="grey--text text--darken-2">work</v-icon>
                                </v-list-tile-avatar>
                                <v-list-tile-content class="grey--text text--darken-2">
                                    {{ __("Contains {$resource->dailies->count()} Dailies") }}
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn flat class="teal teal--text" href="{{ route('timesheets.edit', $resource->id) }}">{{ __('Edit') }}</v-btn>
                            <form action="{{ route('timesheets.generate', $resource->id) }}" method="POST">
                                {{ csrf_field() }}
                                <v-btn type="submit" flat class="ma-0 teal teal--text">{{ __('Generate') }}</v-btn>
                            </form>
                        </v-card-actions>
                    </v-card>
                @endforeach
            </v-flex>
        </v-layout>
    </v-container>
@endsection
