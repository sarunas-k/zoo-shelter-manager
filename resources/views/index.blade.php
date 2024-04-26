@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush

@section('title', 'Management App')

@section('content')

        <div class="admin-menu-big-buttons">
          <a href="{{route('animals.index')}}">
            <div class="big-button first">
              <span>List</span>
            </div>
          </a>
          <a href="{{route('animals.create')}}">
            <div class="big-button">
              <span>Intake</span>
            </div>
          </a>
          <a href="{{route('calls.index')}}">
            <div class="big-button">
              <span>Calls</span>
            </div>
          </a>
          <a href="#">
            <div class="big-button">
              <span>Reports</span>
            </div>
          </a>
        </div>

        <div class="latest-animals">
          <h3>Latest</h3>
        <div class="table-responsive">
          <table class="table table-hover my-4">
            <thead class="table-active">
              <tr>
                <th scope="col">Nr</th>
                <th scope="col">Species</th>
                <th scope="col">Gender</th>
                <th scope="col">Color</th>
                <th scope="col">Name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Living area</th>
              </tr>
            </thead>
            <tbody>
              @foreach($latest_animals as $animal)
                  <tr>
                      <th scope="row"><a href="{{route('animals.show', ['animal' => $animal->id])}}">{{ $animal->list_number }}</a></th>
                      <td>{{ $animal->species->name}}</td>
                      <td>{{ $animal->gender}}</td>
                      <td>{{ $animal->color->name}}</td>
                      <td>{{ $animal->name }}</td>
                      <td>{{ $animal->birthdate }}</td>
                      <td>{{ $animal->living_area->name }}</td>
                  </tr>
              @endforeach
              </tbody>
          </table>
          <a href="{{route('animals.index')}}"><button type="button" class="btn btn-outline-secondary px-5">
            More
          </button></a>
        </div>
        </div>
@endsection