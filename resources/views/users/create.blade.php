@extends('layouts/main')
@section('title', $title)

@section('content')
    <br>
    <h3>{{$title}}</h3>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('users.store')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}">
            </div>
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email address" value="{{old('email')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group col-md-4">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="is-admin">Admin</label>
                <input type="hidden" name="is-admin" value="0">
                <input type="checkbox" id="is-admin" name="is-admin" @if(old('is-admin')) checked @endif>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection