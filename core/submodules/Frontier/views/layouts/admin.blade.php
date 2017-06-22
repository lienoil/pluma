@include("Frontier::partials.header")

@yield("pre-content")

<main id="main" class="main">
    @yield("content")
</main>

@yield("post-content")

@include("Frontier::partials.footer")