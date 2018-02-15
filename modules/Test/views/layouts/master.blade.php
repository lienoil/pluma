@include("Test::partials.head")

    <div id="app" class="application-root" data-application-root>
        <v-app>
            @yield("pre-content")

            @section("pre-container")
                @include("Theme::partials.breadcrumbs")
                {{-- @include("Theme::partials.debug") --}}
            @show

            @yield("root")

            @section("post-container")
                @include("Theme::partials.endnote")
            @show

            @yield("post-content")
        </v-app>
    </div>

@include("Test::partials.foot")
