@extends('layouts/main')
@section('title', 'New Procedure')

@section('content')
<br>
<h3>New procedure @if(isset($animal))- {{$animal->list_number}} {{$animal->name}}@endif</h3>
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
@endif
<form method="POST" action="{{route('procedures.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="procedure-date">Date</label>
            <input type="date" class="form-control" id="procedure-date" name="procedure-date"
                value="{{old('procedure-date') ? old('procedure-date') : date('Y-m-d')}}">
        </div>
        <div class="form-group col-md-4">
            <label for="procedure-type">Procedure</label>
            <select class="form-control" id="procedure-type" name="procedure-type">
                <option>---</option>
                @foreach($procedureTypes as $type)
                <option value="{{$type->id}}" @if(old('procedure-type')==$type->id) selected @endif>{{$type->name}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
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
        <div class="form-group col-md-4">
            <label for="vet">Veterinarian</label>
            <select class="form-control" id="vet" name="vet">
                <option>---</option>
                @foreach($vets as $vet)
                <option value="{{$vet->id}}" @if(old('vet')==$vet->id) selected @endif>
                    {{$vet->first_name}} {{$vet->last_name}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="notes">Notes</label>
            <textarea type="text" rows="10" id="notes" name="notes" class="form-control"
                placeholder="Notes">{{old('notes')}}</textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
