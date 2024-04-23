@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="{{asset('css/animals.css')}}">
@endpush

@section('title', $title)

@section('content')
<br>
<h3>{{$title}}</h3>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@include('partials/animal-card')
<p><strong>Date:</strong> {{$adoption->adoption_date}}</p>
<p><strong>Person:</strong> {{$adoption->person->first_name}} {{$adoption->person->last_name}}</p>
<p><strong>Animal:</strong> {{$adoption->animal->list_number}} {{$adoption->animal->name}}</p>
@if(isset($adoption->return_date))
    <p><strong>Return date:</strong> {{$adoption->return_date}}</p>
@endif
<form method="POST" action="{{route('adoptions.update', ['adoption' => $adoption->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="notes"><strong>Notes:</strong></label>
            <textarea class="form-control" rows="4" id="notes" name="notes">{{$adoption->notes}}</textarea>
        </div>
    </div>
    @if(!isset($adoption->return_date))
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="return-date"><strong>Return date:</strong></label>
            <input type="date" class="form-control" id="return-date" name="return-date">
        </div>
    </div>
    @endif
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
