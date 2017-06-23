@extends("Frontier::layouts.auth")

@section("content")

    <div class="mdl-layout mdl-js-layout mdl-color--grey-100 mdl-color--grey-100">
        <div class="mdl-layout__content">
            <main class="mdl-grid" role="presentation">
                <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">

                    <form action="{{ route('login.login') }}" method="POST" class="mdl-card mdl-shadow--2dp">
                        {{ csrf_field() }}
                        <header class="mdl-card__title">
                            <h3 class="mdl-card__title-text"><strong>{{ $application->site->title }}</strong></h3>
                        </header>

                        <div class="mdl-card__supporting-text">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                {{-- pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" --}}
                                <input id="username" name="username" type="text" class="mdl-textfield__input" value="{{ old('username') }}">
                                <label for="username" class="mdl-textfield__label">Email or username</label>
                                @include('Frontier::errors.span', ['field' => 'username'])
                                {{-- <span class="mdl-textfield__error">The email is invalid</span> --}}
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="password" name="password" type="password" class="mdl-textfield__input" value="{{ old('password') }}">
                                <label for="password" class="mdl-textfield__label">Enter Password</label>
                                @include('Frontier::errors.span', ['field' => 'password'])
                            </div>

                            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                                <input id="remember" type="checkbox" name="remember" class="mdl-checkbox__input">
                                <span class="mdl-checkbox__label">Remember Me</span>
                            </label>
                        </div>

                        <div class="mdl-card__actions">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Login</button>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="#"><small>Register</small></a>
                            <span class="mdl-layout-spacer"></span>
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="#"><small>Forgot password?</small></a>
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