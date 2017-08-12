@include("Theme::partials.header")

<div id="application-root" class="application-root" data-application-root>
    <v-app standalone>

        @yield("pre-content")

        <main data-main>

            @section("pre-container")
                @include("Theme::partials.breadcrumbs")
            @show

            <v-container fluid :style="`font-size: ${settings.fontsize.model}px`">

                @yield("root")

            </v-container>

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
