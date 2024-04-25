@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="{{asset('css/animals.css')}}">
@endpush

@section('title', $title)

@section('content')
    <br>
    <h3>{{$title}}</h3>
    @if(!isset($adoption))
    <p>Incorrect adoption id.</p>
    @else
        @include('partials/animal-card')
        <div class="adoption-edit-button mb-2">
            <a href="{{route('adoptions.edit', ['adoption' => $adoption->id])}}" class="btn btn-primary text-white">Edit</a>
        </div>
        <table class="adoption-details-table table table-bordered ">
            <tr>
                <td style="width: 15%"><strong>Date: </strong></td>
                <td>{{$adoption->adoption_date}}</td>
            </tr>
            <tr>
                <td><strong>Animal: </strong></td>
            <td><a href="{{route('animals.show', ['id' => $adoption->animal->id])}}">{{$adoption->animal->name}} - {{$adoption->animal->list_number}}</a></td>
            </tr>
            <tr>
                <td><strong>Adopter: </strong></td>
                <td><a href="{{route('people.show', ['id' => $adoption->person->id])}}">{{$adoption->person->first_name}} {{$adoption->person->last_name}}</a></td>
            </tr>
            <tr>
                <td><strong>Return: </strong></td>
                <td>{{$adoption->return_date ? $adoption->return_date : 'No'}}</td>
            </tr>
            <tr>
                <td><strong>Notes: </strong></td>
                <td>{{$adoption->notes}}</td>
            </tr>
        </table>
    @endif
@endsection