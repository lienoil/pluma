@include("Theme::partials.header")

<div id="application-root" class="application-root" data-application-root toolbar--fixed toolbar>
    <v-app standalone>

        @yield("pre-content")

        <main id="main" data-main :style="`font-size: ${settings.fontsize.model}px`">

            @section("pre-container")
                @include("Theme::partials.breadcrumbs")
            @show

            @yield("root")

        </main>

        @section("post-container")
            @include("Theme::partials.endnote")
        @show

        @yield("post-content")

    </v-app>
</div>

@section("scripts")
    <script>
        let mixins = [{ data: { page: { model: false, }, }, }];
    </script>
    @stack("pre-scripts")
    <script src='{{ assets("frontier/app/filters.js") }}'></script>
    <script src='{{ assets("frontier/app/dist/app.js") }}'></script>
    @stack("post-scripts")
@show

@include("Theme::partials.footer")
