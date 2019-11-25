@extends('layouts/main')
@section('title', 'Edit Animal')

@section('content')
<br>
<h3>Edit Animal</h3>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(!isset($animal))
<p>Incorrect animal id.</p>
@else
<animal-form 
    :species="{{json_encode($species)}}" 
    :staff="{{json_encode($staff)}}" 
    :livingareas="{{json_encode($livingAreas)}}" 
    :oldvalues="{{json_encode($animal)}}" 
    :colors="{{json_encode($colors)}}"
    :sizes="{{json_encode($sizes)}}"
    :genders="{{json_encode($genders)}}"
    :intaketypes="{{json_encode($intakeTypes)}}"
    :calls="{{json_encode($calls)}}"
    :people="{{json_encode($people)}}"
    csrf="{{csrf_token()}}" 
    date="{{str_replace(' ', 'T', date('Y-m-d H:i'))}}"
    :editform="true"
/>
@endif
@endsection
