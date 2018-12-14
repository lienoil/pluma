<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
  @foreach(get_menu('main-menu') as $menu)
    <li class="nav-item {{ $menu->active ? 'active' : null }}">
      <a class="nav-link" href="{{ $menu->url }}">
        @if ($menu->icon)
          <i class="{{ $menu->icon }}"></i>
        @endif
        {{ __($menu->title) }}
        <span class="sr-only">&nbsp;({{ __('current') }})</span>
      </a>
    </li>
  @endforeach

</ul>
{{-- Login --}}
@if (! auth()->check())
  <span class="nav-item">
    <a role="button" href="{{ route('login.show') }}" class="btn btn-outline-primary">{{ __('Sign in') }}</a>
    <a role="button" href="{{ route('register.show') }}" class="btn btn-primary ml-2">{{ __('Sign up') }}</a>
  </span>
@else
  <span class="nav-item">
    <a href="{{ route('dashboard') }}" role="button" class="btn btn-outline-primary"><i class="mdi mdi-view-dashboard">&nbsp;</i>{{ __('Go to Dashboard') }}</a>
  </span>
@endif
{{-- Login --}}
