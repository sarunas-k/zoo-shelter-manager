@extends('layouts/main')
@section('title', 'Reclaims')

@section('content')
    <br>
    <h3>Reclaims</h3>
    @if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
    @if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
    @if(!isset($reclaims) || $reclaims->count() < 1)
        <p>No reclaim records found.</p>
    @else
        <a href="{{route('reclaims.create')}}" class="btn btn-success text-white my-3">New reclaim</a>
        {{ $reclaims->links() }}
        <table class="table table-bordered  mb-4">
            <thead class="table-dark">
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Return date</th>
                <th scope="col">Animal</th>
                <th scope="col">Reclaimer</th>
              </tr>
            </thead>
            <tbody>
            @foreach($reclaims as $reclaim)
                <tr>
                    <td scope="row" style="width: 10%">
                        <a href="{{route('reclaims.show', ['reclaim' => $reclaim->id])}}">{{ $reclaim->date }}</a>
                    </td>
                    <td scope="row" style="width: 10%">{{ $reclaim->return_date }}</td>
                    <td><a href="{{route('animals.show', ['animal' => $reclaim->animal->id])}}">{{ $reclaim->animal->list_number }} {{$reclaim->animal->name}}</a></td>
                    <td><a href="{{route('people.show', ['id' => $reclaim->person->id])}}">{{ $reclaim->person->first_name }} {{ $reclaim->person->last_name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $reclaims->links() }}
    @endif
@endsection