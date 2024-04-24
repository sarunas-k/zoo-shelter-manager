<div class="animal-card card mb-3">
    <div class="row no-gutters p-2">
        <div>
            <img src="{{Storage::url($animal->images->count() > 0 ? $animal->images->first()->path : '/laravel/public/images/no_image.jpeg')}}" class="card-img" alt="Animal {{$animal->list_number}} - {{$animal->name}}">
        </div>

        <div>
            <div class="card-body px-2 py-0">
                <h5 class="card-title">{{$animal->list_number}} - {{$animal->name}}</h5>
                <table class="table table-sm table-bordered">
                    <tr>
                        <td><strong>Age</strong></td>
                        <td>{{$animal->age}}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender</strong></td>
                        <td>{{$animal->gender}}</td>
                    </tr>
                    <tr>
                        <td><strong>Color</strong></td>
                        <td>{{$animal->color->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Breed</strong></td>
                        <td>{{$animal->breeds_concatenated}}</td>
                    </tr>
                    <tr>
                        <td><strong>In shelter since</strong></td>
                        <td>{{substr($animal->intake_date, 0, 11)}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="animal-badges mx-2">
            @if($animal->is_neutered)<span class="badge badge-pill badge-primary">Spayed/Neutered</span>@endif
            @if($animal->is_fostered)<span class="badge badge-pill badge-success">In Foster</span>@endif
            @if($animal->is_adopted)<span class="badge badge-pill badge-success">Adopted</span>@endif
            @if($animal->is_reclaimed)<span class="badge badge-pill badge-success">Reclaimed</span>@endif
            @if(!$animal->adoptable && !$animal->is_adopted && !$animal->is_reclaimed)<span class="badge badge-pill badge-danger">Not For Adoption</span>@endif
        </div>
    </div>
</div>