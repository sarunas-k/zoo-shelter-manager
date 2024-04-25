@extends('layouts/main')
@section('title', $title)

@section('content')
    <br>
    <h3>{{$title}}</h3>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('staff.store')}}">
        @csrf
        <div class="row mb-3">
            <div class="form-group col-md-4">
                <label class="form-label" for="first-name">First name</label>
                <input type="text" class="form-control border border-dark-subtle" id="first-name" name="first-name" placeholder="First name" value="{{old('first-name')}}">
            </div>
            <div class="form-group col-md-4">
                <label class="form-label" for="last-name">Last name</label>
                <input type="text" class="form-control border border-dark-subtle" id="last-name" name="last-name" placeholder="Last name" value="{{old('last-name')}}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col-md-4">
                <label class="form-label" for="phone">Phone</label>
                <input type="text" class="form-control border border-dark-subtle" id="phone" name="phone" placeholder="Phone">
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col-md-4">
                <label class="form-label" for="is-vet">Vet</label>
                <input type="hidden" name="is-vet" value="0">
                <input type="checkbox" id="is-vet" name="is-vet" @if(old('is-vet')) checked @endif>
            </div>
        </div>
        <button type="submit" class="btn btn-success w-25 my-3">Save</button>
    </form>
@endsection