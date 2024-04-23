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

@if(isset($animal))
    @include('partials/animal-card')
    @if(!$animal->adoptable)
        <div class="alert alert-warning" role="alert"><strong>Notice:</strong> Animal is set as <strong>not for adoption</strong>.</div>
    @endif

    @if($animal->is_fostered)
        <div class="alert alert-danger" role="alert">Animal is <strong>in foster</strong>. Please end current foster to proceed.</div>
    @elseif($animal->is_reclaimed)
        <div class="alert alert-danger" role="alert">Animal is <strong>reclaimed</strong>. Please end current reclaim to proceed.</div>
    @elseif($animal->is_adopted)
        <div class="alert alert-danger" role="alert">Animal is <strong>adopted</strong>. Please end current adoption to proceed.</div>
    @endif
@endif
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
            <searchable-select name="person" :options="{{json_encode($people)}}" display="full_name_with_address" placeholder="Select a person" @if(old('person')) default="{{old('person')}}" @endif/>
        </div>
        @if(isset($animal))
        <input type="hidden" name="animal" id="animal" value="{{$animal->id}}" />
        @else
        <div class="form-group col-md-4">
            <label for="animal">Animal</label>
            <searchable-select name="animal" :options="{{json_encode($animals)}}" placeholder="Select an animal" @if(old('animal')) default="{{old('animal')}}" @endif/>
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
@endsection
