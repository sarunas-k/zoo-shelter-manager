@extends('layouts/main')
@section('title', 'Animals')

@section('content')
<br>
<h3>Animals</h3>
<br>
@if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
@if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
@if(!isset($animals))
<p>No animal records found.</p>
@else
<animals-list></animals-list>
{{-- {{ $animals->appends(request()->input())->links() }}
<div class="filters">
    <a href="{{route('animals.index', ['gender[]' => 'Male'])}}" class="btn btn-primary">Males</a>
    <a href="{{route('animals.index', ['gender[]' => 'Female'])}}" class="btn btn-primary">Females</a>
    <span class="dropdown filter-gender">
        <button class="btn btn-primary dropdown-toggle" type="button" id="menuButtonGender" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Gender
        </button>
        <div class="dropdown-menu px-2" aria-labelledby="menuButtonGender">
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxMale">
                <label class="form-check-label" for="checkboxMale">
                    Male
                </label>
            </div>
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxFemale">
                <label class="form-check-label" for="checkboxFemale">
                    Female
                </label>
            </div>
        </div>
    </span>
    <span class="dropdown filter-species">
        <button class="btn btn-primary dropdown-toggle" type="button" id="menuButtonSpecies" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Species
        </button>
        <div class="dropdown-menu px-2" aria-labelledby="menuButtonSpecies">
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxDogs">
                <label class="form-check-label" for="checkboxDogs">
                    Male
                </label>
            </div>
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxCats">
                <label class="form-check-label" for="checkboxCats">
                    Cats
                </label>
            </div>
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxTurtles">
                <label class="form-check-label" for="checkboxTurtles">
                    Turtles
                </label>
            </div>
        </div>
    </span>
    <span class="dropdown filter-size">
        <button class="btn btn-primary dropdown-toggle" type="button" id="menuButtonSize" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Size
        </button>
        <div class="dropdown-menu px-2" aria-labelledby="menuButtonSize">
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxSizeSmall">
                <label class="form-check-label" for="checkboxSizeSmall">
                    Small
                </label>
            </div>
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxSizeMedium">
                <label class="form-check-label" for="checkboxSizeMedium">
                    Medium
                </label>
            </div>
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxSizeLarge">
                <label class="form-check-label" for="checkboxSizeLarge">
                    Large
                </label>
            </div>
            <div class="form-check dropdown-item">
                <input class="form-check-input" type="checkbox" value="" id="checkboxSizeXLarge">
                <label class="form-check-label" for="checkboxSizeXLarge">
                    Very large
                </label>
            </div>
        </div>
    </span>
    <span class="dropdown filter-color">
            <button class="btn btn-primary dropdown-toggle" type="button" id="menuButtonColor" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Color
            </button>
            <div class="dropdown-menu px-2" aria-labelledby="menuButtonColor">
                <div class="form-check dropdown-item">
                    <input class="form-check-input" type="checkbox" value="" id="checkboxColorBlack">
                    <label class="form-check-label" for="checkboxColorBlack">
                        Black
                    </label>
                </div>
                <div class="form-check dropdown-item">
                    <input class="form-check-input" type="checkbox" value="" id="checkboxColorBrown">
                    <label class="form-check-label" for="checkboxColorBrown">
                        Brown
                    </label>
                </div>
                <div class="form-check dropdown-item">
                    <input class="form-check-input" type="checkbox" value="" id="checkboxColorWhite">
                    <label class="form-check-label" for="checkboxColorWhite">
                        White
                    </label>
                </div>
                <div class="form-check dropdown-item">
                    <input class="form-check-input" type="checkbox" value="" id="checkboxColorBrownBlack">
                    <label class="form-check-label" for="checkboxColorBrownBlack">
                        Brown/Black
                    </label>
                </div>
            </div>
        </span>
</div>

<table class="table table-sm table-bordered my-4">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nr</th>
            <th scope="col">Species</th>
            <th scope="col">Gender</th>
            <th scope="col">Color</th>
            <th scope="col">Name</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Size</th>
            <th scope="col">Intake Date</th>
            <th scope="col">Microchip</th>
            <th scope="col">Living area</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($animals as $animal)
        <tr>
            <th scope="row"><a href="{{route('animals.show', ['id' => $animal->id])}}">{{ $animal->list_number }}</a>
            </th>
            <td>{{ $animal->species->name}}</td>
            <td>{{ $animal->gender}}</td>
            <td>{{ $animal->color->name}}</td>
            <td>{{ $animal->name }}</td>
            <td>{{ $animal->birthdate }}</td>
            <td>{{ $animal->size }}</td>
            <td>{{ substr($animal->intake_date, 0, 11) }}</td>
            <td>{{ $animal->chip_number }}</td>
            <td>{{ $animal->living_area->name }}</td>
            <td><a href="{{route('animals.edit', ['id' => $animal->id])}}" class="btn btn-primary btn-sm">Edit</a></td>
            <td>
                <form method="POST" action="{{route('animals.destroy', ['id' => $animal->id])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $animals->appends(request()->input())->links() }} --}}
@endif
@endsection

@section('scripts')
<script>
    window.onload = function () {
        // SET MENU ITEM AS ACTIVE
        $('.sidebar .nav-link').each((i, element) => {
            if ($(element).text().indexOf('Animals') >= 0)
                $(element).addClass('active');
            else
                $(element).removeClass('active');
        });
    }

</script>
@endsection
