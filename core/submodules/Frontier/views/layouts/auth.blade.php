@include("Frontier::partials.header")

@yield("pre-content")

<v-app id="rootapp">
    @yield("content")
</v-app>

@yield("post-content")

@include("Frontier::partials.footer")
