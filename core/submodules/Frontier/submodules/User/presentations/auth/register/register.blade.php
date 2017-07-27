@extends("Frontier::layouts.auth")

@section("content")
    <register
        :meta="{{ json_encode([
            'title' => __($application->head->title),
            'subtitle' => __($application->site->title),
        ]) }}">

        <v-flex>
            <span class="grey--text">Already have an account?</span>
            <a
                :href="'{{ route('login.show') }}'"
            >Login</a>
        </v-flex>
    </register>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ present("user/auth/register/dist/register.css") }}">
@endpush

@push('pre-js')
    <script src="{{ present("user/auth/register/dist/register.js") }}"></script>
    <script>
        Vue.component('register', register);
    </script>
@endpush
