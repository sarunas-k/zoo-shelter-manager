@extends('layouts/main')
@section('title', 'Animals off shelter')

@section('content')
<br>
<h3>Animals off shelter</h3>
<br>
@if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
@if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif

<animals-index csrf="{{ csrf_token() }}" :nonshelter="true"/>

@endsection
