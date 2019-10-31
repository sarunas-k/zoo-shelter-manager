@extends('layouts/main')
@section('title', 'New Animal')

@section('content')
<br>
<h3>Animals</h3>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<animal-create-form 
    species="{{json_encode($species)}}" 
    staff="{{json_encode($staff)}}" 
    livingareas="{{json_encode($livingAreas)}}" 
    old="{{json_encode(old())}}" 
    colors="{{json_encode($colors)}}"
    sizes="{{json_encode($sizes)}}"
    genders="{{json_encode($genders)}}"
    csrf="{{csrf_token()}}" 
    date="{{str_replace(' ', 'T', date('Y-m-d H:i'))}}"
/>
@endsection
