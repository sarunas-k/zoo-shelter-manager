@extends('layouts/main')
@section('title', 'New Living Area')

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

    <form method="POST" action="{{route('living-areas.store')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="area-name">Name</label>
                <input type="text" class="form-control" id="area-name" name="area-name" value="{{old('area-name')}}">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection