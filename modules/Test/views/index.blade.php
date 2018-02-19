@extends("Single::layouts.admin")

@section("content")

    <router-view></router-view>

@endsection

@push('foot')
    <script>
        let router = new VueRouter;

        router.push({
            path: '/admin/:module/create',
            name: 'tests.create',
            component: New
        });
        console.log(router);
    </script>
@endpush
