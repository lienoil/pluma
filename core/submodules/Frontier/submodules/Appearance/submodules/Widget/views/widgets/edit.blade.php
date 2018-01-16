@extends("Theme::layouts.admin")

@section("head-title", __("Edit $resource->name Visibility"))

@section("content")
    <v-toolbar dark dense class="primary elevation-1 sticky">
        <v-icon dark left>widgets</v-icon>
        <v-toolbar-title class="subheading">{{ __('Edit Widget Visibility') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn flat href="{{ route('widgets.index') }}">{{ __('Back') }}</v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm8 offset-sm2>
                <v-card class="elevation-1 mb-3">
                    <v-toolbar card class="transparent">
                        <v-icon>{{ $resource->icon }}</v-icon>
                        <v-toolbar-title>{{ $resource->name }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <div class="body-1 grey--text">{{ $resource->description }}</div>
                        <input type="hidden" name="id" value="{{ $resource->id }}">
                    </v-card-text>

                    <v-card-text>
                        <div class="body-1 grey--text">{{ __('Only the roles below will be able to see this widget.') }}</div>

                        <v-data-table
                            class="elevation-0"
                            no-data-text="{{ __('No resource found') }}"
                            select-all
                            selected-key="id"
                            {{-- hide-actions --}}
                            {{-- v-bind:search="suppliments.grants.searchform.query"
                            v-bind:headers="suppliments.grants.headers"
                            v-bind:items="suppliments.grants.items"
                            v-model="suppliments.grants.selected" --}}
                            {{-- v-bind:pagination.sync="suppliments.grants.pagination" --}}
                        >
                            <template slot="items" scope="prop">
                                <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                                    <td>
                                        <v-checkbox
                                            primary
                                            hide-details
                                            class="pa-0"
                                            :input-value="prop.selected"
                                        ></v-checkbox>
                                    </td>
                                    <td>@{{ prop.item.name }}</td>
                                </tr>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
