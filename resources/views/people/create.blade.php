@extends('layouts/main')
@section('title', 'New Person')

@section('content')
    <br>
    <h3>People</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('people.store')}}">
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
            <div class="form-group col-md-4">
                <label class="form-label" for="date-of-birth">Date of Birth</label>
            <input type="date" class="form-control border border-dark-subtle" id="date-of-birth" name="date-of-birth" placeholder="Date of Birth" value="{{old('caller-phone')}}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col-md-4">
                <label class="form-label" for="phone-primary">Phone 1</label>
                <input type="text" class="form-control border border-dark-subtle" id="phone-primary" name="phone-primary" placeholder="Phone 1" value="{{old('phone-primary')}}">
            </div>
            <div class="form-group col-md-4">
                <label class="form-label" for="phone-secondary">Phone 2</label>
                <input type="text" class="form-control border border-dark-subtle" id="phone-secondary" name="phone-secondary" placeholder="Phone 2" value="{{old('phone-secondary')}}">
            </div>
            <div class="form-group col-md-4">
                <label class="form-label" for="address">Address</label>
                <input type="text" class="form-control border border-dark-subtle" id="address" name="address" placeholder="Address" value="{{old('address')}}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col-md-8">
                <label class="form-label" for="notes">Notes</label>
                <textarea class="form-control border border-dark-subtle" rows="2" id="notes" name="notes" value="{{old('notes')}}"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success w-25 my-3">Save</button>
    </form>
@endsection