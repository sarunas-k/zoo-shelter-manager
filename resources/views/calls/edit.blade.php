@extends('layouts/main')
@section('title', 'Calls')

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

    @if(!isset($call))
    <p>No call was found.</p>
    @else
    <form method="POST" action="{{route('calls.update', ['id' => $call->id])}}">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="call-date">Call date</label>
                <input type="datetime-local" class="form-control" id="call-date" name="call-date" value="{{$call->date_time_ui_input}}">
            </div>
            <div class="form-group col-md-4">
                <label for="caller-name">Caller name</label>
                <input type="text" class="form-control" id="caller-name" name="caller-name" placeholder="Caller name" value="{{$call->caller_name}}">
            </div>
            <div class="form-group col-md-4">
                <label for="caller-phone">Caller phone</label>
                <input type="text" class="form-control" id="caller-phone" name="caller-phone" placeholder="Caller phone" value="{{$call->caller_phone}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$call->address}}">
            </div>
            <div class="form-group col-md-4">
                    <label for="staff">Responsible staff</label>
                    <searchable-select name="staff" :options="{{json_encode($staff)}}" placeholder="Select a staff member" default="{{$call->staff_id}}"/>
                </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="details">Detailed information</label>
                <textarea class="form-control" rows="3" id="details" name="details" placeholder="Info">{{$call->info}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                        <option @if($call->status == 'Waiting') selected @endif>Waiting</option>
                        <option @if($call->status == 'On hold') selected @endif>On hold</option>
                        <option @if($call->status == 'Finished') selected @endif>Finished</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
    @endif
@endsection