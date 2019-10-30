@extends('layouts/main')
@section('title', 'Living area details')

@section('content')
    <br>
    <heading :level="2">Living Area</heading>
    @if(!isset($livingArea))
        <p>Incorrect living-area id.</p>
    @else
        <table class="table table-bordered table-sm">
            <tr>
                <td><strong>Living area name: </strong></td>
                <td>{{$livingArea->name}}</td>
            </tr>
            <tr>
                <td><strong>Animals: </strong></td>
                <td>
                    @foreach($livingArea->animals as $animal)
                    <a href="{{route('animals.show', ['id' => $animal->id])}}">{{$animal->list_number}}</a><br>
                    @endforeach
                </td>
            </tr>
        </table>
    @endif
@endsection