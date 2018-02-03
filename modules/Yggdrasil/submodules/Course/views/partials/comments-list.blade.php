@if (empty($comments))
    <div class="text-xs-center body-1 grey--text">{{ __('Lay thine eyes upon this field of discourse and thou shalt see that it is barren.') }}</div>
@endif
@foreach ($comments as $comment)
    <v-card flat tile class="transparent">
        <v-list>
            <v-list-tile>
                <v-list-tile-avatar>
                    <img src="{{ $comment->user->avatar }}">
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title class="td-n grey--text text--darken-4 body-2">
                        <a href="{{ route('profile.single', $comment->user->handlename) }}" class="td-n">{{ $comment->user->fullname }}</a>
                    </v-list-tile-title>
                    <v-list-tile-sub-title class="body-1 grey--text">
                        <v-icon left class="body-1">access_time</v-icon> {{ $comment->created }}
                    </v-list-tile-sub-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
        <v-card-text class="pr-0 grey--text text--darken-2">
            <div class="page-content body-1">{!! filter_obscene_words($comment->body) !!}</div>
            <v-card-actions class="grey--text text--darken-2">
                {{-- Upvotes / Downvotes --}}
                <div>
                    <span class="green--text text--lighten-3 body-1">
                        <v-icon class="green--text text--lighten-3 body-1">fa-thumbs-up</v-icon>
                        <em>{{ $comment->upvotes ?? 0 }}</em>
                    </span>
                </div>
                <div>
                    <span class="red--text text--lighten-3 body-1">
                        <v-icon class="red--text text--lighten-3 body-1">fa-thumbs-down</v-icon>
                        <em>{{ $comment->downvotes ?? 0 }}</em>
                    </span>
                </div>
                {{-- Upvotes / Downvotes --}}
                <v-spacer></v-spacer>
                @can('post-comment')
                    <v-btn small accent flat>{{ __('Reply TODO') }}</v-btn>
                @else
                    <v-btn small accent flat disabled>{{ __('Reply') }}</v-btn>
                @endcan
            </v-card-actions>
            <v-divider></v-divider>

            {{-- Replies --}}
            <v-card flat tile class="pl-5">
                @include("Course::partials.comments-list", ['comments' => $comment->replies])
            </v-card>
            {{-- Replies --}}
        </v-card-text>
    </v-card>
@endforeach
