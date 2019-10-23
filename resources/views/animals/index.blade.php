@extends('layouts/main')
@section('title', 'Animals')

@section('content')
<br>
<h3>Animals</h3>
<br>
@if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
@if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
@if(!isset($animals))
<p>No animal records found.</p>
@else
<animals-list csrf="{{ csrf_token() }}"/>
@endif
@endsection
