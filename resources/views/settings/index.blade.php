@extends('layouts/main')
@section('title', 'Settings')

@section('content')
    <br>
    <h2 class="bold" style="margin-left: 1.5rem">Settings</h3>
    @if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
    @if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
    @if(!isset($settings))
        <p>No settings entries found in database.</p>
    @else
        <settings csrf="{{ csrf_token() }}" :settings="{{json_encode($settings)}}" :users="{{json_encode($users)}}" :staff="{{json_encode($staff)}}"/>
    @endif
@endsection