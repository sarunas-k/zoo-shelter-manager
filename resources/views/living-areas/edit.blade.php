@extends('layouts/main')
@section('title', 'Living Areas')

@section('content')
    <br>
    <heading :level="2">Living Areas</heading>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(!isset($livingArea))
        <p>Living area not found.</p>
    @else
        <form method="POST" action="{{route('living-areas.update', ['id' => $livingArea->id])}}">
            @csrf
            @method('PATCH')
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="area-name">Name</label>
                    <input type="text" class="form-control" id="area-name" name="area-name" value="{{$livingArea->name}}">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    @endif
@endsection