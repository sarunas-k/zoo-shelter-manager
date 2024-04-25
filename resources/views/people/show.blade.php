@extends('layouts/main')
@section('title', 'Person details')

@section('content')
<br>
<h3>People</h3>
{{-- PERSON DETAILS --}}
@if(!isset($person))
    <p>Incorrect person id.</p>
@else
<table class="table table-bordered ">
    <tr>
        <td style="width: 15%"><strong>First name: </strong></td>
        <td>{{$person->first_name}}</td>
    </tr>
    <tr>
        <td><strong>Last name: </strong></td>
        <td>{{$person->last_name}}</td>
    </tr>
    <tr>
        <td><strong>Date of birth: </strong></td>
        <td>{{$person->date_of_birth}}</td>
    </tr>
    <tr>
        <td><strong>Phone primary: </strong></td>
        <td>{{$person->phone_first}}</td>
    </tr>
    <tr>
        <td><strong>Phone secondary: </strong></td>
        <td>{{$person->phone_second}}</td>
    </tr>
    <tr>
        <td><strong>Address: </strong></td>
        <td>{{$person->address}}</td>
    </tr>
    <tr>
        <td><strong>Notes: </strong></td>
        <td>{{$person->notes}}</td>
    </tr>
</table>

{{-- PERSON ADOPTIONS --}}
@if(isset($person_adoptions) && $person_adoptions->count() > 0)
<h4>{{$person->first_name}} {{$person->last_name}} Adoptions</h4>
<table class="table table-bordered ">
    <thead class="table-dark">
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Animal</th>
            <th scope="col">Adopter</th>
        </tr>
    </thead>
    <tbody>
        @foreach($person_adoptions as $adoption)
        <tr>
            <td scope="row" style="width: 15%"><a
                    href="{{route('adoptions.show', ['adoption' => $adoption->id])}}">{{ $adoption->adoption_date }}</a></td>
            <td><a href="{{route('animals.show', ['animal' => $adoption->animal->id])}}">{{ $adoption->animal->list_number }}
                    {{$adoption->animal->name}}</a></td>
            <td style="width: 25%">{{ $adoption->person->first_name }} {{ $adoption->person->last_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

{{-- PERSON FOSTERS --}}
@if(isset($person_fosters) && $person_fosters->count() > 0)
<h4>{{$person->first_name}} {{$person->last_name}} Fosters</h4>
<table class="table table-bordered ">
    <thead class="table-dark">
        <tr>
            <th scope="col">Start date</th>
            <th scope="col">End date</th>
            <th scope="col">Animal</th>
            <th scope="col">Fosterer</th>
        </tr>
    </thead>
    <tbody>
        @foreach($person_fosters as $foster)
        <tr>
            <td scope="row" style="width: 15%"><a
                    href="{{route('fosters.show', ['foster' => $foster->id])}}">{{ $foster->foster_start_date }}</a></td>
            <td style="width: 15%">{{ $foster->foster_end_date }}</td>
            <td><a href="{{route('animals.show', ['animal' => $foster->animal->id])}}">{{ $foster->animal->list_number }}
                    {{$foster->animal->name}}</a></td>
            <td style="width: 25%">{{ $foster->person->first_name }} {{ $foster->person->last_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

{{-- PERSON RECLAIMS --}}
@if(isset($person_reclaims) && $person_reclaims->count() > 0)
<h4>{{$person->first_name}} {{$person->last_name}} Reclaims</h4>
<table class="table table-bordered ">
    <thead class="table-dark">
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Animal</th>
            <th scope="col">Reclaimer</th>
        </tr>
    </thead>
    <tbody>
        @foreach($person_reclaims as $reclaim)
        <tr>
            <td scope="row" style="width: 15%"><a
                    href="{{route('reclaims.show', ['reclaim' => $reclaim->id])}}">{{ $reclaim->date }}</a></td>
            <td><a href="{{route('animals.show', ['animal' => $reclaim->animal->id])}}">{{ $reclaim->animal->list_number }}
                    {{$reclaim->animal->name}}</a></td>
            <td style="width: 25%">{{ $reclaim->person->first_name }} {{ $reclaim->person->last_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

{{-- PERSON BRING INS --}}
@if(isset($person->broughtInAnimals) && $person->broughtInAnimals->count() > 0)
<h4>{{$person->first_name}} {{$person->last_name}} Bring ins</h4>
<table class="table table-bordered ">
    <thead class="table-dark">
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Animal</th>
            <th scope="col">Person bringing animal in</th>
        </tr>
    </thead>
    <tbody>
        @foreach($person->broughtInAnimals as $animal)
        <tr>
            <td scope="row" style="width: 15%">{{ $animal->intake_date }}</td>
            <td><a href="{{route('animals.show', ['animal' => $animal->id])}}">{{ $animal->list_number }}
                    {{$animal->name}}</a></td>
            <td style="width: 25%">{{ $animal->bringInPerson->full_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endif
@endsection
