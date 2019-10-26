@extends('layouts/main')
@section('title', 'New Adoption')

@section('content')
<br>
<h3>New adoption @if(isset($animal)) - {{$animal->list_number}}@endif</h3>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(isset($animal))
    @include('partials/animal-card')
    @if(!$animal->is_adoptable)
        <div class="alert alert-warning" role="alert"><strong>Notice:</strong> Animal is set as <strong>not for adoption</strong>.</div>
    @endif
@endif

@if(isset($animal) && $animal->notInShelter())
    <div class="alert alert-danger" role="alert">
        @if($animal->is_fostered)
            Animal is <strong>in foster</strong>. Please end current foster to proceed.
        @elseif($animal->is_reclaimed)
            Animal is <strong>reclaimed</strong>. Please end current reclaim to proceed.
        @elseif($animal->is_adopted)
            Animal is <strong>adopted</strong>. Please end current adoption to proceed.
        @endif
    </div>
@else
<form method="POST" action="{{route('adoptions.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="adoption-date">Date</label>
            <input type="date" class="form-control" id="adoption-date" name="adoption-date"
                value="{{old('adoption-date') ? old('adoption-date') : date('Y-m-d')}}">
        </div>
        <div class="form-group col-md-4">
            <label for="person">Person</label>
            <select class="form-control" id="person" name="person">
                <option>---</option>
                @foreach($people as $person)
                <option value="{{$person->id}}" @if(old('person')==$person->id) selected @endif>{{$person->first_name}}
                    {{$person->last_name}}</option>
                @endforeach
            </select>
        </div>
        @if(isset($animal))
        <input type="hidden" name="animal" id="animal" value="{{$animal->id}}" />
        @else
        <div class="form-group col-md-4">
            <label for="animal">Animal</label>
            <select class="form-control" id="animal" name="animal">
                <option>---</option>
                @foreach($animals as $animal)
                <option value="{{$animal->id}}" @if(old('animal')==$animal->id) selected @endif>{{$animal->list_number}}
                    {{$animal->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="notes">Notes</label>
            <textarea class="form-control" rows="4" id="notes" name="notes" value="{{old('notes')}}"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endif
@endsection
