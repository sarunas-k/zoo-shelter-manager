@extends('layouts/main')
@section('title', 'Animals')

@section('content')
<br>
<heading :level="2">Animals</heading>
<br>
@if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
@if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
@if(!isset($animals))
<p>No animal records found.</p>
@else
<animals-index csrf="{{ csrf_token() }}"/>
@endif
@endsection
