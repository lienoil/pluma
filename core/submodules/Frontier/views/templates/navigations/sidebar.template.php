@if ($menus->count())
    <nav role="navigation" class="mdl-navigation" data-depth="{{ isset($depth) ? $depth : $depth = 1 }}">
        @foreach ($menus as $menu)
            <a class="mdl-navigation__link" href="{{ url($menu->slug) }}">{{ $menu->labels->title }}</a>
            @if ($menu->has_children)
                @include("Frontier::templates.navigations.sidebar", ['menus' => collect($menu->children), 'depth' => ++$depth])
            @endif
        @endforeach
    </nav>
@endif
