@extends('layouts/main')
@section('title', 'Search')

@section('content')
    <br>
    <h3>Search for "{{request()->input('q')}}"</h3>
    <br>
    @if(!isset($animals_results) || $animals_results->count() < 1)
    <p>No animals matched search criteria.</p>
    @else
        {{ $animals_results->appends(request()->input())->links() }}
        <div class="table-responsive">
          <table class="table table-bordered  my-4">
            <thead class="table-dark">
              <tr>
                <th scope="col">Nr</th>
                <th scope="col">Species</th>
                <th scope="col">Gender</th>
                <th scope="col">Color</th>
                <th scope="col">Name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Living area</th>
                <th scope="col">Microchip number</th>
              </tr>
            </thead>
            <tbody>
              @foreach($animals_results as $animal)
                  <tr>
                      <th scope="row"><a href="{{route('animals.show', ['animal' => $animal->id])}}">{{ $animal->list_number }}</a></th>
                      <td>{{ $animal->species->name}}</td>
                      <td>{{ $animal->gender}}</td>
                      <td>{{ $animal->color->name}}</td>
                      <td>{{ $animal->name }}</td>
                      <td>{{ $animal->birthdate }}</td>
                      <td>{{ $animal->living_area->name }}</td>
                      <td>{{ $animal->chip_number }}</td>
                  </tr>
              @endforeach
              </tbody>
          </table>
        </div>
        {{ $animals_results->appends(request()->input())->links() }}
    @endif
@endsection