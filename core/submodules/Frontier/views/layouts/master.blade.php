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
        let mixins = [{
            data: {
                page: {
                    model: false,
                },
            },
        }];
    </script>
    @stack("pre-scripts")
    <script src='{{ present("frontier/app/filters.js") }}'></script>
    <script src='{{ present("frontier/app/dist/app.js") }}'></script>
    <script>
        // Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=_token]').getAttribute('value');
        // const app = new Vue({
        //     el: '#application-root',
        //     mixins : mixins,
        //     data: {
        //         dark: true, light: false,
        //         mini: false, drawer: true,
        //         menu: {
        //             open: false,
        //         },
        //         theme: {
        //             avatar: 'red',
        //             utilitybar: 'white',
        //         },
        //     },
        // });
    </script>
    @stack("post-scripts")
@show

@include("Theme::partials.footer")
