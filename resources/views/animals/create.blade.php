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
<animal-form 
    :species="{{json_encode($species)}}" 
    :staff="{{json_encode($staff)}}" 
    :livingareas="{{json_encode($livingAreas)}}" 
    :oldvalues="{{json_encode(old())}}" 
    :colors="{{json_encode($colors)}}"
    :sizes="{{json_encode($sizes)}}"
    :genders="{{json_encode($genders)}}"
    :intaketypes="{{json_encode($intakeTypes)}}"
    :calls="{{json_encode($calls)}}"
    :people="{{json_encode($people)}}"
    csrf="{{csrf_token()}}" 
    date="{{str_replace(' ', 'T', date('Y-m-d H:i'))}}"
/>
@endsection
