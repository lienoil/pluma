@if (Session::has('type') && Session::has('message'))
    <div role="alert" class="alert alert-{{ Session::get('type') }} mt-3">
        <div class="banner-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span>{!! Session::get('icon') or '' !!}{!! Session::get('title') !!}</span>
            {!! Session::get('message') !!}
        </div>
    </div>
@endif