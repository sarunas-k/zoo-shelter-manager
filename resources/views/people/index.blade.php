@extends('layouts/main')
@section('title', 'People')

@section('content')
    <br>
    <h3>People</h3>
    <br>
    @if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
    @if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
    @if(!isset($people))
    <p>No people records found.</p>
    @else
        {{ $people->appends(request()->input())->links() }}
        <table class="table table-sm table-bordered my-4">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nr</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
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
                    <th scope="row"><a href="{{route('people.show', ['id' => $person->id])}}">{{ $index+1 }}</a></th>
                    <td>{{ $person->first_name}}</td>
                    <td>{{ $person->last_name}}</td>
                    <td>{{ $person->date_of_birth}}</td>
                    <td>{{ $person->phone_first }}</td>
                    <td>{{ $person->phone_second }}</td>
                    <td>{{ $person->address }}</td>
                    <td><a href="{{route('people.edit', ['id' => $person->id])}}" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>
                        <form method="POST" action="{{route('people.destroy', ['id' => $person->id])}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $people->appends(request()->input())->links() }}
    @endif
@endsection

@section('scripts')
    <script>
        window.onload = function () {
            // SET MENU ITEM AS ACTIVE
            $('.sidebar .nav-link').each((i, element) => {
                if ($(element).text().indexOf('persons') >= 0)
                    $(element).addClass('active');
                else
                    $(element).removeClass('active');
            });
        }
    </script>
@endsection