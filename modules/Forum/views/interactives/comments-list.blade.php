@foreach ($comments as $comment)
    <v-divider></v-divider>
    <v-card flat>
        <v-toolbar card class="transparent">
            <v-avatar size="30px">
                <img src="{{ $comment->user->avatar }}">
            </v-avatar>
            <v-toolbar-title class="subheading body-1">
                {{ $comment->user->displayname }}
                <div class="subheading body-1 grey--text"><v-icon left class="body-1 grey--text">access_time</v-icon> {{ $comment->created }}</div>
            </v-toolbar-title>
        </v-toolbar>
        <v-card-text class="body-1 grey--text text--darken-2 transparent">
            {!! $comment->body !!}
            <div>

                <v-slide-y-transition>
                    <v-card class="elevation-0 mb-3" transition="slide-y-transition">
                        <v-btn primary flat @click="commentforms.f{{ $comment->id }} = !commentforms.f{{ $comment->id }}">Reply</v-btn>
                        <v-card-text ref="commentforms_{{ $resource->id }}" v-show="!commentforms.f{{ $comment->id }}">
                            <form class="hidden-sm-up" action="{{ route('forums.comment', $resource->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ user()->id }}">
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                {{-- editor --}}
                                <v-card flat class="outlined" style="border: 1px solid #cacaca">
                                    @include("Forum::widgets.editor", ['paper' => false])
                                </v-card>
                                {{-- <v-divider></v-divider> --}}
                                <v-card-text class="text-xs-right p-0">
                                    <v-btn type="submit" flat primary>{{ __('Post Reply') }}</v-btn>
                                </v-card-text>
                            </form>
                        </v-card-text>
                    </v-card>
                </v-slide-y-transition>
            </div>
        </v-card-text>
        <v-card flat class="pl-4 transparent">
            @if ($comment->hasReplies())
                <v-card-text class="pl-4">
                    @include("Forum::interactives.comments-list", ['comments' => $comment->replies])
                </v-card-text>
            @endif
        </v-card>
    </v-card>
    {{-- <v-divider></v-divider> --}}
@endforeach
