@extends('layouts/main')
@section('title', 'Living Areas')

@section('content')
    <br>
    <h3>Living Areas</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(!isset($livingArea))
        <p>Living area not found.</p>
    @else
        <form method="POST" action="{{route('living-areas.update', ['id' => $livingArea->id])}}">
            @csrf
            @method('PATCH')
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="area-name">Name</label>
                    <input type="text" class="form-control" id="area-name" name="area-name" value="{{$livingArea->name}}">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    @endif
@endsection

@section('scripts')
    <script>
        window.onload = function () {
            // SET MENU ITEM AS ACTIVE
            $('.sidebar .nav-link').each((i, element) => {
                if ($(element).text().indexOf('Living Areas') >= 0)
                    $(element).addClass('active');
                else
                    $(element).removeClass('active');
            });
        }
    </script>
@endsection