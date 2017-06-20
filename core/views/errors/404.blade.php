@extends("Frontier::layouts.public")

@section("head.title", "404 Error")

@section("content")
    <p>404 {{ $error['code'] }}</p>
    <p>{{ $error['message'] }}</p>
    <p>{{ $error['description'] }}</p>
@endsection