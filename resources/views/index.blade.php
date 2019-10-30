@extends('layouts/main')
@section('title', 'Animal Shelter Management System')

@section('content')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <heading :level="2">Dashboard</heading>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>

        {{-- <div>
          <div style="width: 23.75%; height:300px; border: 1px solid grey; float: left; margin-left: 1%; position: relative">
            <span style="position: absolute; left: 50%; top: 50%; transform: translateX(-50%) translateY(-50%); font-family: 'Nunito', sans-serif; font-size: 30px; text-align: center;">Shelter view</span></div>
          <div style="width: 23.75%; height:300px; border: 1px solid grey; float: left; margin-left: 1%; position: relative">
            <span style="position: absolute; left: 50%; top: 50%; transform: translateX(-50%) translateY(-50%); font-family: 'Nunito', sans-serif; font-size: 30px; text-align: center;">Animal intake</span></div>
          <div style="width: 23.75%; height:300px; border: 1px solid grey; float: left; margin-left: 1%; position: relative">
            <span style="position: absolute; left: 50%; top: 50%; transform: translateX(-50%) translateY(-50%); font-family: 'Nunito', sans-serif; font-size: 30px; text-align: center;">Call registration</span></div>
          <div style="width: 23.75%; height:300px; border: 1px solid grey; float: left; margin-left: 1%; position: relative">
            <span style="position: absolute; left: 50%; top: 50%; transform: translateX(-50%) translateY(-50%); font-family: 'Nunito', sans-serif; font-size: 30px; text-align: center;">Calendar</span></div>
        </div> --}}
  
        <div class="latest-animals" style="clear: left">
          <h3>Latest intakes</h3>
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
                      <th scope="row"><a href="{{route('animals.show', ['id' => $animal->id])}}">{{ $animal->list_number }}</a></th>
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