@extends("Frontier::layouts.public")

@section("css", "")

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <header class="header">
                    <h1 class="page-title">{{ __($page->title) }}</h1>
                </header>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <main id="main" class="main">
                    {!! __($page->body) !!}
                </main>
            </div>
        </div>
    </div>
@endsection
