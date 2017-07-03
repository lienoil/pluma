@include("Single::partials.header")

<div id="root-app">
    {{-- @include("Single::partials.sidebar") --}}
    <v-toolbar></v-toolbar>
    <main>
        <v-container fluid>
            @{{ message }}
            <router-view></router-view>
        </v-container>
    </main>
    <v-footer></v-footer>
</div>

@include("Single::partials.footer")
