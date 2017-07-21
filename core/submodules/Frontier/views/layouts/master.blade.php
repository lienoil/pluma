@include("Frontier::partials.header")

<div id="application-root" class="application-root" data-application-root>
    <v-app standalone>

        @yield("pre-content")

        <main data-main>
            @include("Frontier::partials.breadcrumbs")
            <v-container fluid>

                @yield("root")

            </v-container>
        </main>

        @include("Frontier::partials.endnote")

        @yield("post-content")

    </v-app>
</div>

@section("scripts")
    <script>
        let mixins = [];
    </script>
    @stack("pre-scripts")
    <script>

        const app = new Vue({
            el: '#application-root',
            mixins : mixins,
            data: {
                dark: true, light: false,
                mini: false, drawer: true,
                menu: {
                    open: false,
                },
                theme: {
                    avatar: 'red',
                    utilitybar: 'white',
                },
            },
        });

    </script>
    @stack("post-scripts")
@show

@include("Frontier::partials.footer")
