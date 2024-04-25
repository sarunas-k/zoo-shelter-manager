@extends('layouts/main')
@section('title', 'Call details')

@section('content')
    <br>
    <h3>Calls</h3>
    @if(!isset($call))
    <p>Incorrect call id.</p>
    @else
        <table class="table table-bordered ">
            <tr>
                <td style="width: 15%"><strong>Date: </strong></td>
                <td>{{$call->date_time}}</td>
            </tr>
            <tr>
                <td><strong>Caller name: </strong></td>
                <td>{{$call->caller_name}}</td>
            </tr>
            <tr>
                <td><strong>Caller phone: </strong></td>
                <td>{{$call->caller_phone}}</td>
            </tr>
            <tr>
                <td><strong>Address: </strong></td>
                <td>{{$call->address}}</td>
            </tr>
            <tr>
                <td><strong>Details: </strong></td>
                <td>{{$call->info}}</td>
            </tr>
            <tr>
                <td><strong>Created at: </strong></td>
                <td>{{$call->created_at}}</td>
            </tr>
            <tr>
                <td><strong>Updated at: </strong></td>
                <td>{{$call->updated_at}}</td>
            </tr>
            <tr>
                <td><strong>Staff: </strong></td>
                <td>{{$call->staff->first_name}} {{$call->staff->last_name}}</td>
            </tr>
            <tr>
                <td><strong>Status: </strong></td>
                <td>{{$call->status}}</td>
            </tr>
        </table>
    @endif
@endsection