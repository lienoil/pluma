@include("Theme::partials.head")

@yield("pre-content")

<div id="app" data-application-root>
    <v-app standalone>
        @yield("content")
    </v-app>
</div>

@yield("post-content")

@include("Theme::partials.foot")
