@extends('layouts/main')
@section('title', 'Reports')

@section('content')
    <br>
    <heading :level="2">Reports</heading>
    <br>
    @if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
    @if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
    <reports></reports>
@endsection