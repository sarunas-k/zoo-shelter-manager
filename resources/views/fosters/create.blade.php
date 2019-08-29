@extends('layouts/main')
@section('title', 'New Foster')

@section('content')
<br>
<h3>New foster @if(isset($animal))- {{$animal->list_number}}@endif</h3>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(isset($animal))
@include('partials/animal-card')
@endif
<form method="POST" action="{{route('fosters.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="start-date">Start date</label>
            <input type="date" class="form-control" id="start-date" name="start-date"
                value="{{old('start-date') ? old('start-date') : date('Y-m-d')}}">
        </div>
        <div class="form-group col-md-4">
            <label for="person">Person</label>
            <select class="form-control" id="person" name="person">
                <option>---</option>
                @foreach($people as $person)
                <option value="{{$person->id}}" @if(old('person')==$person->id) selected @endif>{{$person->first_name}}
                    {{$person->last_name}}</option>
                @endforeach
            </select>
        </div>
        @if(isset($animal))
        <input type="hidden" name="animal" id="animal" value="{{$animal->id}}" />
        @else
        <div class="form-group col-md-4">
            <label for="animal">Animal</label>
            <select class="form-control" id="animal" name="animal">
                <option>---</option>
                @foreach($animals as $animal)
                <option value="{{$animal->id}}" @if(old('animal')==$animal->id) selected @endif>{{$animal->list_number}}
                    {{$animal->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="notes">Notes</label>
            <textarea class="form-control" rows="4" id="notes" name="notes" value="{{old('notes')}}"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection

@section('scripts')
<script>
    // SET MENU ITEM AS ACTIVE
    $('.sidebar .nav-link').each((i, element) => {
        if ($(element).text().indexOf('Fosters') >= 0)
            $(element).addClass('active');
        else
            $(element).removeClass('active');
    });

</script>
@endsection
