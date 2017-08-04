@extends("Frontier::layouts.auth")

@section("content")
    <div class="mdl-layout mdl-js-layout mdl-color--grey-100 mdl-color--grey-100">
        <div class="mdl-layout__content">
            <main class="mdl-grid" role="presentation">
                <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">

                    @include("Frontier::partials.alert")

                    <form action="{{ route('register.register') }}" method="POST" class="mdl-card mdl-shadow--2dp">
                        {{ csrf_field() }}
                        <header class="mdl-card__title">
                            <h3 class="mdl-card__title-text">{{ __('Register') }}&nbsp;<span class="mdl-color-text--grey-500">| {{ $application->site->title }}</span></h3>
                        </header>

                        <div class="mdl-card__supporting-text">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                {{-- pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" --}}
                                <input id="email" name="email" type="email" class="mdl-textfield__input" value="{{ old('email') }}">
                                <label for="email" class="mdl-textfield__label">{{ __('Email') }}</label>
                                {{-- <span class="mdl-textfield__error">The email is invalid</span> --}}
                            </div>
                            @include('Frontier::errors.span', ['field' => 'email'])

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="password" name="password" type="password" class="mdl-textfield__input" value="{{ old('password') }}">
                                <label for="password" class="mdl-textfield__label">{{ __('Password') }}</label>
                            </div>
                            @include('Frontier::errors.span', ['field' => 'password'])

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="password_confirmation" name="password_confirmation" type="password" class="mdl-textfield__input" value="{{ old('password_confirmation') }}">
                                <label for="password_confirmation" class="mdl-textfield__label">{{ __('Confirm Password') }}</label>
                            </div>
                            @include('Frontier::errors.span', ['field' => 'password_confirmation'])
                        </div>

                        <div class="mdl-card__supporting-text">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">{{ __('Register') }}</button>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ route('login.show') }}"><small>{{ __('Login') }}</small></a>
                        </div>
                    </form>

                    <div class="copy">
                        <small class="mdl-color-text--blue-grey-400">{{ $application->site->copyright }}</small>
                    </div>

                </div>
                <div class="mdl-layout-spacer"></div>
            </main>
        </div>
    </div>

@endsection
