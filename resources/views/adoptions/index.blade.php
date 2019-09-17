@extends('layouts/main')
@section('title', 'Adoptions')

@section('content')
<br>
<h3>Adoptions</h3>
<br>
@if(session('success')) <div class="alert alert-success" role="alert">  {{ session('success') }}</div>@endif
@if(session('error'))   <div class="alert alert-danger" role="alert">   {{ session('error') }}  </div>@endif
@if(count($adoptions) > 0)
{{ $adoptions->links() }}
<table class="table table-bordered table-sm my-4">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Adoption date</th>
            <th scope="col">Return date</th>
            <th scope="col">Animal</th>
            <th scope="col">Adopter</th>
        </tr>
    </thead>
    <tbody>
        @foreach($adoptions as $adoption)
        <tr>
            <td scope="row" style="width: 10%">
                <a href="{{route('adoptions.show', ['id' => $adoption->id])}}">{{ $adoption->adoption_date }}</a></td>
            <td style="width: 10%"> {{ $adoption->return_date }}</td>
            <td><a href="{{route('animals.show', ['id' => $adoption->animal->id])}}">{{ $adoption->animal->list_number }}
                {{$adoption->animal->name}}</a></td>
            <td><a href="{{route('people.show', ['id' => $adoption->person->id])}}">{{ $adoption->person->first_name }}
                {{$adoption->person->last_name}}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $adoptions->links() }}
@else
<p>No adoption records found.</p>
@endif
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
