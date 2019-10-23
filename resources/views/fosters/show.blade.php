@extends('layouts/main')
@section('title', 'Fosters')

@section('content')
    <br>
    <h3>Fosters</h3>
    @if(!isset($foster))
        <p>Incorrect foster id.</p>
    @else
        @include('partials/animal-card')
        <div class="foster-edit-button mb-2">
            <a href="{{route('fosters.edit', ['id' => $foster->id])}}" class="btn btn-primary btn-sm">Edit</a>
        </div>  
        <table class="foster-details-table table table-bordered table-sm">
            <tr>
                <td style="width: 15%"><strong>Start date: </strong></td>
                <td>{{$foster->foster_start_date}}</td>
            </tr>
            <tr>
                <td><strong>End date: </strong></td>
                <td>@if(isset($foster->foster_end_date)){{$foster->foster_end_date}}@endif</td>
            </tr>
            <tr>
                <td><strong>Animal: </strong></td>
            <td><a href="{{route('animals.show', ['id' => $foster->animal->id])}}">{{$foster->animal->name}} - {{$foster->animal->list_number}}</a></td>
            </tr>
            <tr>
                <td><strong>Fosterer: </strong></td>
                <td><a href="{{route('people.show', ['id' => $foster->person->id])}}">{{$foster->person->first_name}} {{$foster->person->last_name}}</a></td>
            </tr>
            <tr>
                <td><strong>Notes: </strong></td>
                <td>{{$foster->notes}}</td>
            </tr>
        </table>
    @endif
@endsection