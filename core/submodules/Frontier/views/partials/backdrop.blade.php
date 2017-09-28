<div id="backdrop" class="grey lighten-4" style="position: fixed; width: 100vw; height: 100vh;z-index:99999"></div>
@push('post-js')
    <script>
        (function () {
            let $backdrop = document.querySelector('#backdrop');
            setTimeout(function () {
                $backdrop.remove();
            }, 200);
        })();
    </script>
@endpush
