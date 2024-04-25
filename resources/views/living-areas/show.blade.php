@extends('layouts/main')
@section('title', 'Living area details')

@section('content')
    <br>
    <h3>Living area</h3>
    @if(!isset($livingArea))
        <p>Incorrect living-area id.</p>
    @else
        <table class="table table-bordered ">
            <tr>
                <td><strong>Living area name: </strong></td>
                <td>{{$livingArea->name}}</td>
            </tr>
            <tr>
                <td><strong>Animals: </strong></td>
                <td>
                    @foreach($livingArea->animals as $animal)
                    <a href="{{route('animals.show', ['animal' => $animal->id])}}">{{$animal->list_number}}</a><br>
                    @endforeach
                </td>
            </tr>
        </table>
    @endif
@endsection