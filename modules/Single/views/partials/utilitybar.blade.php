<header class="mdl-layout__header mdl-layout__header--suppliment">
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">{{ $application->page->title }}</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
            <a role="button" class="mdl-navigation__link" href="">Some</a>
            <a role="button" class="mdl-navigation__link" href="">Utility</a>
            <a role="button" class="mdl-navigation__link" href="">Links</a>
            <a role="button" class="mdl-navigation__link" href="">Profile</a>
        </nav>

        @include("Frontier::partials.search")
    </div>
</header>
