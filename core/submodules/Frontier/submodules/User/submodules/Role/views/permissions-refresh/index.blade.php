@extends("Frontier::layouts.admin")

@section("content")
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">

            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--expand">
                    <h2 class="mdl-card__title-text">{{ trans('Update Permissions') }}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenan convallis.
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        View Updates
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
