@extends('layouts/main')
@section('title', 'New Reclaim')

@section('content')
    <br>
    <h3>New reclaim @if(isset($animal))- {{$animal->list_number}}@endif</h3>
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

    @if(isset($animal) && $animal->notInShelter())
        <div class="alert alert-danger" role="alert">
            @if($animal->in_foster)
                Animal is <strong>in foster</strong>. Please end current foster to proceed with this reclaim.
            @elseif($animal->reclaimed)
                Animal is <strong>reclaimed</strong>. Please end current reclaim to proceed with this reclaim.
            @elseif($animal->adopted)
                Animal is <strong>adopted</strong>. Please end current adoption to proceed with this reclaim.
            @endif
        </div>
    @else
    <form method="POST" action="{{route('reclaims.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{old('date') ? old('date') : date('Y-m-d')}}">
            </div>
            <div class="form-group col-md-6">
                <label for="person">Person</label>
                <select class="form-control" id="person" name="person">
                    <option>---</option>
                    @foreach($people as $person)
                        <option value="{{$person->id}}" @if(old('person') == $person->id) selected @endif>{{$person->first_name}} {{$person->last_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if(isset($animal))
        <input type="hidden" name="animal" id="animal" value="{{$animal->id}}" />
        @else
        <div class="form-row">
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
        </div>
        @endif
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endif
@endsection

@section('scripts')
    <script>
        window.onload = function () {
            // SET MENU ITEM AS ACTIVE
            $('.sidebar .nav-link').each((i, element) => {
                if ($(element).text().indexOf('Reclaims') >= 0)
                    $(element).addClass('active');
                else
                    $(element).removeClass('active');
            });
        }
    </script>
@endsection