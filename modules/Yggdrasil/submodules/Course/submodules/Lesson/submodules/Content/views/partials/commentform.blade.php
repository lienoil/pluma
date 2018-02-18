@if (user())
    @can('post-comment')
        <v-alert info v-show="'true'" v-model="alert" dismissible>
            {{ __('Please observe proper guidelines when posting comments.') }}
        </v-alert>
    @else
        <v-alert warning v-show="'true'" v-model="alert" dismissible>
            {{ __('Your credentials does not meet the requirements to post comments.') }}
        </v-alert>
    @endcan
@else
    <v-alert info v-show="'true'" v-model="alert" dismissible>
        {{ __('Login to post comments.') }}
    </v-alert>
@endif
<form action="{{ route('contents.comment', $resource->id) }}" method="POST">
    {{ csrf_field() }}
    <v-card flat class="transparent">
        <input type="hidden" name="type" value="contents">
        @if (user())
            <input type="hidden" name="user_id" value="{{ user()->id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        @endif

        {{-- editor --}}
        @include("Content::widgets.editor", ['isPaper' => ($isPaper ?? 'true')])
        {{-- editor --}}

        <v-divider></v-divider>

        <v-card-actions>
            @if(user())
                @can('post-comment')
                    <v-btn flat @click="$refs[`commentform-{{ $comment->id ?? 'random' }}`].style.display='none'">{{ __('Cancel') }}</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" flat primary>{{ __('Post Comment') }}</v-btn>
                @endcan
            @else
                <span class="pa-2 body-1 grey--text"><a class="td-n" href="{{ route('login.show', ['redirect_to' => route('contents.show', $resource->slug) . '#post-comments']) }}">{{ __('Login') }}</a> {{ __('and join the discourse.') }}</span>
                <v-spacer></v-spacer>
                <v-btn disabled flat primary>{{ __('Post Comment') }}</v-btn>
            @endif
        </v-card-actions>
    </v-card>
</form>
