@extends('layouts.admin')

@section('content')
    @isset($route)
        @include('components.forms.importForm')
    @endisset

    @isset($route2)
        @include('components.forms.importForm')
    @endisset

    @include('components.tables.' . $table)
@endsection
