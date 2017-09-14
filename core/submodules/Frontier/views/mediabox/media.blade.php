<mediabox :toolbar-items="[
        {code:'all', count:100,title:'All',icon:'perm_media', url: '{{ route('api.library.all') }}' },
        {code:'albums', count:69,title:'Albums',icon:'album'},
        {code:'collections', count:99,title:'Collections',icon:'collections'},
    ]"
></mediabox>
