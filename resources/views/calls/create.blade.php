@extends('layouts/main')
@section('title', 'New Call')

@section('content')
    <br>
    <h3>Calls</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('calls.store')}}">
        @csrf
        <div class="row mb-3">
            <div class="form-group col col-md-4">
                <label class="form-label" for="call-date">Call date</label>
                <input type="datetime-local" class="form-control border border-dark-subtle" id="call-date" name="call-date" value="{{old('call-date') ? old('call-date') : str_replace(' ', 'T', date('Y-m-d H:i'))}}">
            </div>
            <div class="form-group col col-md-4">
                <label class="form-label" for="caller-name">Caller name</label>
                <input type="text" class="form-control border border-dark-subtle" id="caller-name" name="caller-name" placeholder="Caller name" value="{{old('caller-name')}}">
            </div>
            <div class="form-group col col-md-4">
                <label class="form-label" for="caller-phone">Caller phone</label>
            <input type="text" class="form-control border border-dark-subtle" id="caller-phone" name="caller-phone" placeholder="Caller phone" value="{{old('caller-phone')}}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col col-md-8">
                <label class="form-label" for="address">Address</label>
                <input type="text" class="form-control border border-dark-subtle" id="address" name="address" placeholder="Address" value="{{old('address')}}">
            </div>
            <div class="form-group col col-md-4">
                <label class="form-label" for="staff">Responsible staff</label>
                <searchable-select name="staff" :options="{{json_encode($staff)}}" placeholder="Select a staff member" @if(old('staff')) default="{{old('staff')}}" @endif/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col col-md-8">
                <label class="form-label" for="details">Detailed information</label>
                <textarea class="form-control border border-dark-subtle" rows="3" id="details" name="details" placeholder="Info">{{old('details')}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success text-white m-1 w-25">Save</button>
    </form>
@endsection