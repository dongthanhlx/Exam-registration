@extends('layouts.admin')

@section('content')
    @include('components.forms.importForm')
    @include('components.tables.' . $table)
@endsection
