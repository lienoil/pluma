@include("Single::partials.header")

    <div data-root-app>
        @include("Single::partials.sidebar")
        @include("Single::partials.toolbar")
        <main>
            <v-container fluid></v-container>
        </main>
        @include("Single::partials.endnote")
    </div>

    <script>
        var app = new Vue({
            el: '[data-root-app]',
            data: {
                message: 'Hello Vue!',
                application: JSON.parse('{!! json_encode($application) !!}'),
                sidebar: JSON.parse('{!! json_encode($navigation->sidebar->collect) !!}'),
                drawer: true,
                mini: false,
                dark: true,
            }
        });
    </script>

@include("Single::partials.footer")
