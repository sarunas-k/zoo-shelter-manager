@extends('layouts/main')
@section('title', 'Living Areas')

@section('content')
    <br>
    <h3>Living Areas</h3>
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
            <div class="form-row row mb-3">
                <div class="form-group col-md-4">
                    <label class="form-label" for="area-name">Name</label>
                    <input type="text" class="form-control border border-dark-subtle" id="area-name" name="area-name" value="{{$livingArea->name}}">
                </div>
            </div>
            <button type="submit" class="btn btn-success text-white w-25 my-3">Save</button>
        </form>
    @endif
@endsection