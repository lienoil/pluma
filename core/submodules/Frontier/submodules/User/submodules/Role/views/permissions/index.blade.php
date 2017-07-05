@extends("Frontier::layouts.admin")

@section("content")
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <table class="mdl-data-table mdl-shadow--2dp">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">ID</th>
                        <th>Name</th>
                        <th>Code</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($resources->isEmpty())
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric" colspan="100%">
                                <div class="mdl-typography--text-center">No resource found</div>
                            </td>
                        </tr>
                    @endif

                    @foreach ($resources as $resource)
                    <tr>
                        <td>{{ $resource->id }}</td>
                        <td>{{ $resource->name }} <span>{{ $resource->description }}</span></td>
                        <td>{{ $resource->code }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
