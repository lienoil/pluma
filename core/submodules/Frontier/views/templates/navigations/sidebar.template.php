@if ($menus->count())
    <nav role="navigation" class="mdl-navigation" data-depth="{{ isset($depth) ? $depth : $depth = 1 }}">
        @foreach ($menus as $menu)

            @if (isset($menu->is_header) && $menu->is_header)
                <{{ $menu->markup or 'span' }} class="{{ $menu->class }}">{{ $menu->text }}</{{ $menu->markup or 'span' }}>
            @elseif (isset($menu->is_separator) && $menu->is_separator)
                <{{ $menu->markup or 'hr' }} class="{{ $menu->class }}"></{{ $menu->markup or 'hr' }}>
            @else
                <a class="mdl-navigation__link" href="{{ url($menu->slug) }}">{{ $menu->labels->title }}</a>
                @if ($menu->has_children)
                    @include("Frontier::templates.navigations.sidebar", ['menus' => collect($menu->children), 'depth' => ++$depth])
                @endif
            @endif

        @endforeach
    </nav>
@endif
