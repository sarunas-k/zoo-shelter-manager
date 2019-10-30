@extends('layouts/main')
@section('title', 'Edit Reclaim')

@section('content')
<br>
<heading :level="2">Edit reclaim</heading>
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
<p><strong>Date:</strong> {{$reclaim->date}}</p>
@if(isset($reclaim->return_date))
    <p><strong>Return date:</strong> {{$reclaim->return_date}}</p>
@endif
<p><strong>Person:</strong> {{$reclaim->person->first_name}} {{$reclaim->person->last_name}}</p>
<p><strong>Animal:</strong> {{$reclaim->animal->list_number}} {{$reclaim->animal->name}}</p>
<form method="POST" action="{{route('reclaims.update', ['id' => $reclaim->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @if(!isset($reclaim->return_date))
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="return-date"><strong>Return date:</strong></label>
            <input type="date" class="form-control" id="return-date" name="return-date">
        </div>
    </div>
    @endif
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="notes"><strong>Notes:</strong></label>
            <textarea class="form-control" rows="4" id="notes" name="notes">{{$reclaim->notes}}</textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
