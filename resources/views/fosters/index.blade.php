@extends('layouts/main')
@section('title', 'Fosters')

@section('content')
    <br>
    <h3>Fosters</h3>
    <br>
    @if(session('success')) <div class="alert alert-success" role="alert">  {{ session('success') }}</div>@endif
    @if(session('error'))   <div class="alert alert-danger" role="alert">   {{ session('error') }}  </div>@endif
    @if(!isset($fosters) || $fosters->count() < 1)
    <p>No fosters records found.</p>
    @else
        {{ $fosters->links() }}
        <table class="table table-bordered table-sm my-4">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Animal</th>
                <th scope="col">Fosterer</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
            @foreach($fosters as $foster)
                <tr>
                    <td scope="row" style="width: 15%"><a href="{{route('fosters.show', ['id' => $foster->id])}}">{{ $foster->foster_start_date }}</a></td>
                    <td style="width: 15%">{{ $foster->foster_end_date }}</td>
                    <td><a href="{{route('animals.show', ['id' => $foster->animal->id])}}">{{ $foster->animal->list_number }} {{$foster->animal->name}}</a></td>
                    <td><a href="{{route('people.show', ['id' => $foster->person->id])}}">{{ $foster->person->first_name }} {{ $foster->person->last_name }}</a></td>
                <td>@if($foster->foster_end_date) <span class="badge badge-pill badge-secondary">Finished</span> @else <span class="badge badge-pill badge-success">Active</span> @endif</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $fosters->links() }}
    @endif
@endsection

@section('scripts')
    <script>
        // SET MENU ITEM AS ACTIVE
        $('.sidebar .nav-link').each((i, element) => {
            if ($(element).text().indexOf('Fosters') >= 0)
                $(element).addClass('active');
            else
                $(element).removeClass('active');
        });
    </script>
@endsection