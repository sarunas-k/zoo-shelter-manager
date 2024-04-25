@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="{{asset('css/animals.css')}}">
@endpush

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
    <div class="row mb-3">
        <div class="form-group col-md-4">
            <label class="form-label" for="procedure-date">Date</label>
            <input type="date" class="form-control border border-dark-subtle" id="procedure-date" name="procedure-date"
                value="{{old('procedure-date') ? old('procedure-date') : date('Y-m-d')}}">
        </div>
        <div class="form-group col-md-4">
            <label class="form-label" for="procedure-type">Procedure</label>
            <select class="form-control border border-dark-subtle" id="procedure-type" name="procedure-type">
                <option>---</option>
                @foreach($procedureTypes as $type)
                <option value="{{$type->id}}" @if(old('procedure-type')==$type->id) selected @endif>{{$type->name}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        @if(isset($animal))
        <input type="hidden" name="animal" id="animal" value="{{$animal->id}}" />
        @else
        <div class="form-group col-md-4">
            <label class="form-label" for="animal">Animal</label>
            <select class="form-control border border-dark-subtle" id="animal" name="animal">
                <option>---</option>
                @foreach($animals as $animal)
                <option value="{{$animal->id}}" @if(old('animal')==$animal->id) selected @endif>{{$animal->list_number}}
                    {{$animal->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="form-group col-md-4">
            <label class="form-label" for="vet">Veterinarian</label>
            <searchable-select name="vet" :options="{{json_encode($vets)}}" placeholder="Select a vet" @if(old('vet')) default="{{old('vet')}}" @endif/>
        </div>
    </div>
    <div class="row mb-3">
        <div class="form-group col-md-8">
            <label class="form-label" for="notes">Notes</label>
            <textarea type="text" rows="10" id="notes" name="notes" class="form-control border border-dark-subtle"
                placeholder="Notes">{{old('notes')}}</textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-success w-25 my-3">Save</button>
</form>
@endsection
