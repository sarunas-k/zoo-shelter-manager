@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="{{asset('css/animals.css')}}">
@endpush

@section('title', 'Reclaims')

@section('content')
    <br>
    <h3>Reclaims</h3>
    @if(!isset($reclaim))
        <p>Incorrect reclaim id.</p>
    @else
        @include('partials/animal-card')
        <div class="reclaim-edit-button mb-2">
            <a href="{{route('reclaims.edit', ['reclaim' => $reclaim->id])}}" class="btn btn-primary btn-sm">Edit</a>
        </div>
        <table class="reclaim-details-table table table-bordered table-sm">
            <tr>
                <td style="width: 15%"><strong>Date: </strong></td>
                <td>{{$reclaim->date}}</td>
            </tr>
            <tr>
                <td><strong>Return date: </strong></td>
                <td>@if(isset($reclaim->return_date)){{$reclaim->return_date}}@endif</td>
            </tr>
            <tr>
                <td><strong>Animal: </strong></td>
            <td><a href="{{route('animals.show', ['animal' => $reclaim->animal->id])}}">{{$reclaim->animal->name}} - {{$reclaim->animal->list_number}}</a></td>
            </tr>
            <tr>
                <td><strong>Reclaimer: </strong></td>
                <td><a href="{{route('people.show', ['id' => $reclaim->person->id])}}">{{$reclaim->person->first_name}} {{$reclaim->person->last_name}}</a></td>
            </tr>
            <tr>
                <td><strong>Notes: </strong></td>
                <td>{{$reclaim->notes}}</td>
            </tr>
        </table>
    @endif
@endsection