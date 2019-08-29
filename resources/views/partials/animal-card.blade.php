<div class="animal-card card mb-3">
    <div class="row no-gutters p-2">
        <div>
            <img src="{{Storage::url($animal->images->first()->path)}}" class="card-img" alt="Animal {{$animal->list_number}} - {{$animal->name}}"
                style="object-fit: cover; height: 200px; width: 200px">
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
                {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
            </div>
        </div>
        <div class="animal-badges mx-2" style="width: 150px;">
            @if($animal->is_neutered)<span class="badge badge-pill badge-primary" style="width: 150px">Spayed/Neutered</span>@endif
            @if($animal->in_foster)<span class="badge badge-pill badge-success" style="width: 150px">In Foster</span>@endif
            @if(!$animal->is_adoptable)<span class="badge badge-pill badge-danger" style="width: 150px">Not For Adoption</span>@endif
        </div>
    </div>
</div>