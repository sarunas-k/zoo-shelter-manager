@extends('layouts/main')

@push('styles')
<link rel="stylesheet" href="{{asset('css/animals.css')}}">
@endpush

@section('title', 'Animal details')

@section('content')
<br>
<h3>Animals</h3>
@if(session('success'))<div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
@if(session('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(!isset($animal))
<p>Animal not found.</p>
@else
<div class="animal-details-top">
    <a href="{{route('animals.edit', ['animal' => $animal->id])}}" class="btn btn-link edit-button">Edit</a> |
    <form method="POST" action="{{route('animals.destroy', ['animal' => $animal->id])}}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-link">Delete</button>
    </form>
</div>
@include('partials/animal-card')
<!-- Animal details tabs navigation -->
<ul class="nav nav-tabs" id="animal-details-tabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" id="animal-profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
            aria-controls="profile" aria-selected="true">Details</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="notes-tab" data-bs-toggle="tab" href="#notes" role="tab"
            aria-controls="notes" aria-selected="true">Notes</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="vet-visits-tab" data-bs-toggle="tab" href="#vet-visits" role="tab"
            aria-controls="vet-visits" aria-selected="false">Vet visits</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="files-tab" data-bs-toggle="tab" href="#files" role="tab" aria-controls="files"
            aria-selected="false">Files</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" role="tab" aria-controls="images"
            aria-selected="false">Images</button>
    </li>
    <li class="nav-item">
        <a class="btn nav-link" id="adopt-tab" href="{{route('adoptions.create', ['animal_id' => $animal->id])}}">Adopt</a>
    </li>
    <li class="nav-item">
        <a class="btn nav-link" id="adopt-tab" href="{{route('fosters.create', ['animal_id' => $animal->id])}}">Foster</a>
    </li>
    <li class="nav-item">
        <a class="btn nav-link" id="adopt-tab" href="{{route('reclaims.create', ['animal_id' => $animal->id])}}">Reclaim</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content mb-3">
    <!-- TAB 1: Animal details -->
    <div class="tab-pane p-3 active p-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <table class="table table-bordered  animal-details-table">
            <tr>
                <td class="number-column"><strong>Number: </strong></td>
                <td>{{$animal->list_number}}</td>
            </tr>
            <tr>
                <td><strong>Species: </strong></td>
                <td>{{$animal->species->name}}</td>
            </tr>
            <tr>
                <td><strong>Intake type: </strong></td>
                <td>{{$animal->intakeType->name}}</td>
            </tr>
            <tr>
                <td><strong>Gender: </strong></td>
                <td>{{$animal->gender}}</td>
            </tr>
            <tr>
                <td><strong>Breed: </strong></td>
                <td>{{$animal->breeds_concatenated}}</td>
            </tr>
            <tr>
                <td><strong>Color: </strong></td>
                <td>{{$animal->color->name}}</td>
            </tr>
            <tr>
                <td><strong>Name: </strong></td>
                <td>{{$animal->name}}</td>
            </tr>
            <tr>
                <td><strong>Date of Birth: </strong></td>
                <td>{{$animal->birthdate}}</td>
            </tr>
            <tr>
                <td><strong>Size: </strong></td>
                <td>{{$animal->size}}</td>
            </tr>
            <tr>
                <td><strong>Spayed/neutered: </strong></td>
                <td>{{$animal->is_neutered ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <td><strong>Intake date: </strong></td>
                <td>{{$animal->intake_date}}</td>
            </tr>
            <tr>
                <td><strong>Microchip number: </strong></td>
                <td>{{$animal->chip_number}}</td>
            </tr>
            <tr>
                <td><strong>Living area: </strong></td>
                <td>{{$animal->living_area->name}}</td>
            </tr>
            @if(isset($animal->call))
                <tr>
                    <td><strong>Reference call: </strong></td>
                    <td>
                        <a href="{{route('calls.show', ['call' => $animal->call->id])}}">{{$animal->call->name}}</a>
                    </td>
                </tr>
            @endif
            <tr>
                <td><strong>Person bringing animal in: </strong></td>
                <td>
                    @if(isset($animal->bringInPerson))
                        <a href="{{route('people.show', ['id' => $animal->bringInPerson->id])}}">{{$animal->bringInPerson->full_name}}</a>
                    @else
                        Unknown
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Staff: </strong></td>
                <td>{{$animal->staff->first_name}} {{$animal->staff->last_name}}</td>
            </tr>
        </table>
    </div>
    <div class="tab-pane p-3" id="notes" role="tabpanel" aria-labelledby="notes-tab">
        @if($animal->notes)
            {{$animal->notes}}
        @else
            There are no notes for this animal.
        @endif
    </div>
    <!-- TAB 3: Vet visits -->
    <div class="tab-pane p-3" id="vet-visits" role="tabpanel" aria-labelledby="vet-visits-tab">
        <a href="{{route('procedures.create.for.animal', ['id' => $animal->id])}}"
            class="btn btn-primary text-white text-center">New procedure</a><br><br>
        @if($animal->procedures->count() < 1) <p>There are no vet visit records for this animal.</p>
            @else
            <table class="table table-bordered ">
                <thead>
                    <th style="width: 15%">Date</th>
                    <th style="width: 20%">Procedure</th>
                    <th style="width: 45%">Notes</th>
                    <th style="width: 20%">Veterinarian</th>
                </thead>
                @foreach($animal->procedures as $procedure)
                <tr>
                    <td>{{$procedure->date}}</td>
                    <td>{{$procedure->type->name}}</td>
                    <td>{{$procedure->notes}}</td>
                    <td>{{$procedure->vet->first_name}}
                        {{$procedure->vet->last_name}}</td>
                </tr>
                @endforeach
            </table>
            @endif
    </div>
    <!-- TAB 4: Animal files -->
    <div class="tab-pane p-3" id="files" role="tabpanel" aria-labelledby="files-tab">
        No files yet.
    </div>
    <!-- TAB 5: Animal images -->
    <div class="tab-pane p-3" id="images" role="tabpanel" aria-labelledby="images-tab">
        <div class="animal-images">
            @if ($animal->images->count() > 0)
                @foreach($animal->images as $image)
                <div class="animal-image">
                    <a href="{{Storage::url($image->path)}}" target="_blank"><img src="{{Storage::url($image->path)}}"></a>
                </div>
                @endforeach
            @else
                <p>No images yet.</p>
            @endif
        </div>
    </div>
</div>
@endif
@endsection
