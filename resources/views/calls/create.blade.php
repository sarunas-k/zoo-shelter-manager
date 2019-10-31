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
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="call-date">Call date</label>
                <input type="datetime-local" class="form-control" id="call-date" name="call-date" value="{{old('call-date') ? old('call-date') : str_replace(' ', 'T', date('Y-m-d H:i'))}}">
            </div>
            <div class="form-group col-md-4">
                <label for="caller-name">Caller name</label>
                <input type="text" class="form-control" id="caller-name" name="caller-name" placeholder="Caller name" value="{{old('caller-name')}}">
            </div>
            <div class="form-group col-md-4">
                <label for="caller-phone">Caller phone</label>
            <input type="text" class="form-control" id="caller-phone" name="caller-phone" placeholder="Caller phone" value="{{old('caller-phone')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{old('address')}}">
            </div>
            <div class="form-group col-md-4">
                <label for="staff">Responsible staff</label>
                <select class="form-control" id="staff" name="staff">
                    <option>---</option>
                    @foreach($staff as $staffMember)
                        <option value="{{$staffMember->id}}" @if(old('staff') == $staffMember->id) selected @endif>{{$staffMember->first_name}} {{$staffMember->last_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="details">Detailed information</label>
                <textarea class="form-control" rows="3" id="details" name="details" placeholder="Info">{{old('details')}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection