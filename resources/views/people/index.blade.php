@extends('layouts/main')
@section('title', 'People')

@section('content')
    <br>
    <h3>People</h3>
    @if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
    @if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
    @if(!isset($people))
        <p>No people records found.</p>
    @else
        <a href="{{route('people.create')}}" class="btn btn-success text-white my-3">
            <span data-feather="user"></span>
            New person
        </a>
        {{ $people->appends(request()->input())->links() }}
        <table class="table table-bordered my-4">
            <thead class="table-dark">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Phone 1</th>
                <th scope="col">Phone 2</th>
                <th scope="col">Address</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach($people as $index => $person)
                <tr>
                    {{-- <td scope="row">{{ $index+1 }}</th> --}}
                    <td><a href="{{route('people.show', ['id' => $person->id])}}">{{ $person->first_name}} {{$person->last_name}}</a></td>
                    <td>{{ $person->date_of_birth}}</td>
                    <td>{{ $person->phone_first }}</td>
                    <td>{{ $person->phone_second }}</td>
                    <td>{{ $person->address }}</td>
                    <td>
                        <a href="{{route('people.edit', ['id' => $person->id])}}" class="btn btn-primary btn-sm text-white">Edit</a>
                    </td>
                    <td>
                        <delete-button action="{{route('people.destroy', ['id' => $person->id])}}" csrf="{{csrf_token()}}"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $people->appends(request()->input())->links() }}
    @endif
@endsection