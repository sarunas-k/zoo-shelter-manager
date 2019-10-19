@extends('layouts/main')
@section('title', 'Edit Person')

@section('content')
    <br>
    <h3>People</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(!isset($person))
    <p>Person was not found.</p>
    @else
    <form method="POST" action="{{route('people.update', ['id' => $person->id])}}">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="first-name">First name</label>
                <input type="text" class="form-control" id="first-name" name="first-name" placeholder="First name" value="{{$person->first_name}}">
            </div>
            <div class="form-group col-md-4">
                <label for="last-name">Last name</label>
                <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last name" value="{{$person->last_name}}">
            </div>
            <div class="form-group col-md-4">
                <label for="date-of-birth">Date of Birth</label>
            <input type="date" class="form-control" id="date-of-birth" name="date-of-birth" placeholder="Date of Birth" value="{{$person->date_of_birth}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="phone-primary">Phone 1</label>
                <input type="text" class="form-control" id="phone-primary" name="phone-primary" placeholder="Phone 1" value="{{$person->phone_first}}">
            </div>
            <div class="form-group col-md-4">
                <label for="phone-secondary">Phone 2</label>
                <input type="text" class="form-control" id="phone-secondary" name="phone-secondary" placeholder="Phone 2" value="{{$person->phone_second}}">
            </div>
            <div class="form-group col-md-4">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$person->address}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="notes">Notes</label>
                <textarea class="form-control" rows="2" id="notes" name="notes">{{$person->notes}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
    @endif
@endsection

@section('scripts')
    <script>
        window.onload = function () {
            // SET MENU ITEM AS ACTIVE
            $('.sidebar .nav-link').each((i, element) => {
                if ($(element).text().indexOf('People') >= 0)
                    $(element).addClass('active');
                else
                    $(element).removeClass('active');
            });
        }
    </script>
@endsection