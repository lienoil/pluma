@extends("Theme::layouts.admin")

{{-- @section("Pluma::partials.breadcrumb") --}}
@section("content")
    <v-container fluid>
        {{-- replies --}}
        <v-card-text>
            {{-- <div id="comments-container"></div> --}}
            @include(
                "Comment::widgets.comments",
                [
                    "post"=>route('api.forums.comment', $resource->id),
                    "all" => route('api.forums.all', $resource->id),
                    "put"=>route('api.forums.update', $resource->id)
                ]
            )
        </v-card-text>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('Frontier/jquery-comments/css/jquery-comments.css') }}">
    <style>
        /* start of jquery-comments*/
            .spinner {
                display: none !important;
            }

            .btn-danger {
                background: #D8462A !important;
                color: #fff !important;
            }

            .wrapper {
                background: #fff !important;
            }

            .content {
                min-height: 0 !important;
            }

            .edit {
                position: static !important;
            }
        /*end of jquery-comments*/

        .card-image a img {
            border-radius: 50% !important;
            padding: 20px;
        }

        .top-border {
            border-top: 2px dotted #d8d8d8;
        }

        .collection {
            border: none !important;
        }

        .collection .collection-item:hover {
            background: transparent !important;
        }

        .collection .collection-item:last-child {
            border-bottom: none !important;
            margin-bottom: 0 !important;
        }

        .bold-weight {
            font-weight: 500;
        }

        .m-b-1 {
            margin-bottom: 10px !important;
        }

        .m-b-2 {
            margin-bottom: 20px !important;
        }

        .m-t-2 {
            margin-top: 20px !important;
        }

        .collection-item .new:after {
            content: '' !important;
        }

        .badge .badge-danger {
            color: #D8462A;
        }

        .badge .badge-success {
            color: #5cb85c;
        }

        .font-14 {
            font-size: 14px !important;
        }

        .reveal-position {
            position: absolute;
            top: 0;
            right: 0;
        }

        .text-center {
            text-align: center;
        }

        /*editable*/
        .edit {
            display:block;
            cursor: pointer;
            position: relative;
            left: 100px;

        }
    </style>
@endpush
