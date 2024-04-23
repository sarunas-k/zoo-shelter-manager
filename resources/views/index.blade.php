@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush

@section('title', 'Management App')

@section('content')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 bold">Dashboard</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>

        <div class="admin-menu-big-buttons">
          <a href="{{route('animals.index')}}">
            <div class="big-button first">
              <span>Animals in shelter</span>
            </div>
          </a>
          <a href="{{route('animals.create')}}">
            <div class="big-button">
              <span>Animal intake</span>
            </div>
          </a>
          <a href="{{route('calls.index')}}">
            <div class="big-button">
              <span>Call registration</span>
            </div>
          </a>
          <a href="#">
            <div class="big-button">
              <span>Calendar</span>
            </div>
          </a>
        </div>

        <div class="latest-animals">
          <h3>Latest animals</h3>
        <div class="table-responsive">
          <table class="table table-bordered table-sm my-4">
            <thead class="thead-dark">
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
          <a href="{{route('animals.index')}}"><button type="button" class="btn btn-sm btn-outline-primary">
            More
          </button></a>
        </div>
        </div>
@endsection