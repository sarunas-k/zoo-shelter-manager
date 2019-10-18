@extends('layouts/main')
@section('title', 'Edit Foster')

@section('content')
<br>
<h3>Edit foster</h3>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@include('partials/animal-card')
<p><strong>Date:</strong> {{$foster->foster_start_date}}</p>
@if(isset($foster->foster_end_date))
    <p><strong>Foster end date:</strong> {{$foster->foster_end_date}}</p>
@endif
<p><strong>Person:</strong> {{$foster->person->first_name}} {{$foster->person->last_name}}</p>
<p><strong>Animal:</strong> {{$foster->animal->list_number}} {{$foster->animal->name}}</p>
<form method="POST" action="{{route('fosters.update', ['id' => $foster->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @if(!isset($foster->foster_end_date))
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="end-date"><strong>Foster end date:</strong></label>
            <input type="date" class="form-control" id="end-date" name="end-date">
        </div>
    </div>
    @endif
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="notes"><strong>Notes:</strong></label>
            <textarea class="form-control" rows="4" id="notes" name="notes">{{$foster->notes}}</textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection

@section('scripts')
<script>
    window.onload = function () {
        // SET MENU ITEM AS ACTIVE
        $('.sidebar .nav-link').each((i, element) => {
            if ($(element).text().indexOf('Fosters') >= 0)
                $(element).addClass('active');
            else
                $(element).removeClass('active');
        });
    }

</script>
@endsection
