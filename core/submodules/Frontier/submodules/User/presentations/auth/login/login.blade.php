@extends("Frontier::layouts.auth")

@section("content")
    <login
        :meta="{{ json_encode([
            'title' => __($application->head->title),
            'subtitle' => __($application->site->title),
        ]) }}">
        <v-flex>
            <a
                :href="'{{ url('/admin/register') }}'"
            >Register</a>
        </v-flex>
    </login>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ present("user/{$application->token}/auth/login/dist/login.css") }}">
@endpush

@push('pre-js')
    <script src="{{ present("user/{$application->token}/auth/login/dist/login.js") }}"></script>
    <script>
        Vue.component('login', login);
    </script>
@endpush
