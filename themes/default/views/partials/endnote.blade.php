<v-footer class="white bt-1 grey--text">
    @yield('endnote')

    @section("back-to-top")
        @include("Theme::partials.back-to-top-button")
    @show
</v-footer>
