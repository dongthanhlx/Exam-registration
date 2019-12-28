@extends('layouts.admin')

@section('content')
    @isset($route)
        @include('components.forms.importForm')
    @endisset

    @include('components.tables.' . $table)
@endsection
