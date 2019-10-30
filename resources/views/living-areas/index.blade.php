@extends('layouts/main')
@section('title', 'Living Areas')

@section('content')
    <br>
    <heading :level="2">Living Areas</heading>
    <br>
    @if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
    @if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
    <form method="POST" action="{{route('living-areas.store')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <input type="text" class="form-control form-control-sm" id="area-name" name="area-name" placeholder="Living area name" value="{{old('area-name')}}">
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success btn-sm">Add</button>
            </div>
        </div>
    </form>
    @if(!isset($living_areas) || $living_areas->count() < 1)
        <p>No living area records found.</p>
    @else
        {{ $living_areas->links() }}
        <table class="table table-bordered table-sm my-4">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width: 20%">Name</th>
                <th scope="col" style="width: 55%">Animals</th>
                <th scope="col" style="width: 10%"></th>
                <th scope="col" style="width: 10%"></th>
              </tr>
            </thead>
            <tbody>
            @foreach($living_areas as $index => $area)
                <tr>
                    <td>{{ $area->name}}</td>
                    <td>
                        @foreach($area->animals as $animal)
                            <a href="{{route('animals.show', ['id' => $animal->id])}}">{{$animal->list_number}}</a><br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <a href="{{route('living-areas.edit', ['id' => $area->id])}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td class="text-center">
                        <delete-button action="{{route('living-areas.destroy', ['id' => $area->id])}}" csrf="{{csrf_token()}}"/>>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $living_areas->links() }}
    @endif
@endsection