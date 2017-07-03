@include("Frontier::partials.header")

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">

    @yield("pre-content")

    @include("Frontier::partials.utilitybar")

    @include("Frontier::partials.sidebar")

    <main id="main" class="mdl-layout__content">
        <div class="page-content">
            @yield("content")
        </div>
    </main>

    @yield("post-content")

</div>

@include("Frontier::partials.footer")
