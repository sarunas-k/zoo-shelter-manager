@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="{{asset('css/animals.css')}}">
@endpush

@section('title', 'New Reclaim')

@section('content')
    <br>
    <h3>New reclaim</h3>
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

        @if($animal->is_fostered)
            <div class="alert alert-danger" role="alert">Animal is <strong>in foster</strong>. Please end current foster to proceed.</div>
        @elseif($animal->is_reclaimed)
            <div class="alert alert-danger" role="alert">Animal is <strong>reclaimed</strong>. Please end current reclaim to proceed.</div>
        @elseif($animal->is_adopted)
            <div class="alert alert-danger" role="alert">Animal is <strong>adopted</strong>. Please end current adoption to proceed.</div>
        @endif
    @endif
    <form method="POST" action="{{route('reclaims.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row row mb-3">
            <div class="form-group col-md-4">
                <label class="form-label" for="date">Date</label>
                <input type="date" class="form-control border border-dark-subtle" id="date" name="date" value="{{old('date') ? old('date') : date('Y-m-d')}}">
            </div>
            <div class="form-group col-md-4">
                <label class="form-label" for="person">Person</label>
                <searchable-select name="person" :options="{{json_encode($people)}}" display="full_name_with_address" placeholder="Select a person" @if(old('person')) default="{{old('person')}}" @endif/>
            </div>
            @if(isset($animal))
                <input type="hidden" name="animal" id="animal" value="{{$animal->id}}" />
            @else
                <div class="form-group col-md-4">
                    <label class="form-label" for="animal">Animal</label>
                    <searchable-select name="animal" :options="{{json_encode($animals)}}" placeholder="Select an animal" @if(old('animal')) default="{{old('animal')}}" @endif/>
                </div>
            @endif
        </div>
        <div class="form-row row mb-3">
            <div class="form-group col-md-8">
                <label class="form-label" for="notes">Notes</label>
                <textarea class="form-control border border-dark-subtle" rows="4" id="notes" name="notes" value="{{old('notes')}}"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection