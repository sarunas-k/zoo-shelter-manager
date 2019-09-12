@extends('layouts/main')
@section('title', 'Edit Adoption')

@section('content')
<br>
<h3>Edit adoption</h3>
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
<p><strong>Date:</strong> {{$adoption->adoption_date}}</p>
<p><strong>Person:</strong> {{$adopter->first_name}} {{$adopter->last_name}} - {{$adopter->id}}</p>
<form method="POST" action="{{route('adoptions.update', ['id' => $adoption->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="notes">Notes</label>
            <textarea class="form-control" rows="4" id="notes" name="notes">{{$adoption->notes}}</textarea>
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
            if ($(element).text().indexOf('Adoptions') >= 0)
                $(element).addClass('active');
            else
                $(element).removeClass('active');
        });
    }

</script>
@endsection