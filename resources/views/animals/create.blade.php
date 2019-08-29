@extends('layouts/main')
@section('title', 'New Animal')

@section('content')
<br>
<h3>Animals</h3>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form method="POST" action="{{route('animals.index')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="animal-number">Animal number</label>
            <input type="text" class="form-control" id="animal-number" name="animal-number" placeholder="Number"
                value="{{old('animal-number')}}">
        </div>
        <div class="form-group col-md-4">
            <label for="species">Species</label>
            <select class="form-control" id="species" name="species">
                <option>---</option>
                @foreach($species as $speciesItem)
                <option value="{{$speciesItem->id}}" @if(old('species')==$speciesItem->id) selected @endif>{{$speciesItem->name}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option>---</option>
                <option @if(old('gender')=='Male' ) selected @endif>Male</option>
                <option @if(old('gender')=='Female' ) selected @endif>Female</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{old('name')}}">
        </div>
        <div class="form-group col-md-4">
            <label for="birthdate">Date of Birth</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{old('birthdate')}}">
        </div>
        <div class="form-group col-md-4">
            <label for="color">Color</label>
            <select class="form-control" id="color" name="color">
                <option>---</option>
                @foreach($colors as $color)
                <option value="{{$color->id}}" @if(old('color')==$color->id) selected @endif>{{$color->name}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="breed">Breed</label>
            <select class="form-control" id="breed" name="breed[]" multiple>
                @foreach($species as $speciesItem)
                @if($speciesItem->breeds()->count() > 0)
                <optgroup label="{{$speciesItem->name}}">
                    @foreach($speciesItem->breeds as $breed)
                    <option value="{{$breed->id}}" @if(old('breed')==$breed->id) selected @endif>{{$breed->name}}
                    </option>
                    @endforeach
                </optgroup>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="staff">Responsible staff</label>
            <select class="form-control" id="staff" name="staff">
                <option>---</option>
                @foreach($staff as $staffMember)
                <option value="{{$staffMember->id}}" @if(old('staff')==$staffMember->id) selected @endif>{{$staffMember->first_name}}
                    {{$staffMember->last_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="microchip">Microchip number</label>
            <input type="text" class="form-control" id="microchip" name="microchip" placeholder="Microchip number"
                value="{{old('microchip')}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="size">Size</label>
            <select class="form-control" id="size" name="size">
                <option>---</option>
                <option @if(old('size')=='Small' ) selected @endif>Small</option>
                <option @if(old('size')=='Medium' ) selected @endif>Medium</option>
                <option @if(old('size')=='Large' ) selected @endif>Large</option>
                <option @if(old('size')=='Very large' ) selected @endif>Very large</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="intake-date">Intake Date</label>
            <input type="datetime-local" class="form-control" id="intake-date" name="intake-date"
                value="{{old('intake-date') ? old('intake-date') : str_replace(' ', 'T', date('Y-m-d H:i'))}}">
        </div>
        <div class="form-group col-md-4">
            <label for="living-area">Living area</label>
            <select class="form-control" id="living-area" name="living-area">
                <option>---</option>
                @foreach($livingAreas as $livingArea)
                <option value="{{$livingArea->id}}" @if(old('living-area')==$livingArea->id) selected
                    @endif>{{$livingArea->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <input type="hidden" name="is-neutered" value="0">
            <input type="checkbox" name="is-neutered" id="is-neutered">
            <label for="is-neutered">Spayed/neutered</label>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="animal-image">Image</label><br>
            <input type="file" class="form-control-file" name="animal-image[]" id="animal-image" multiple>
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
            if ($(element).text().indexOf('Add Animal') >= 0)
                $(element).addClass('active');
            else
                $(element).removeClass('active');
        });
    }
</script>
@endsection
