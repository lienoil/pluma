@include("Theme::partials.header")

@yield("pre-content")

<div id="application-root" class="application-root" data-application-root>
    <v-app standalone>
        @yield("content")
    </v-app>
</div>

@yield("post-content")

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
