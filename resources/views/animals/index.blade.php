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
<animals-list csrf="{{ csrf_token() }}"/>
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
