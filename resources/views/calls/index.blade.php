@extends('layouts/main')
@section('title', 'Calls')

@section('content')
    <br>
    <h3>Calls</h3>
    <br>
    @if(session('success')) <div class="alert alert-success" role="alert">{{session('success')}}</div>@endif
    @if(session('error')) <div class="alert alert-danger" role="alert">{{session('error')}}</div>@endif
    @if(!isset($calls) || $calls->count() < 1)
    <p>No call records found.</p>
    @else
        {{ $calls->links() }}
        <table class="table table-bordered  my-4">
            <thead class="table-dark">
              <tr>
                <th scope="col" style="width: 10%">Date</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Information</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach($calls as $call)
                <tr>
                    <td scope="row"><a href="{{route('calls.show', ['call' => $call->id])}}">{{ substr($call->date_time, 0, 10) }}<br>{{substr($call->date_time, 10, 6)}}</a></td>
                    <td>{{ $call->caller_name}}</td>
                    <td>{{ $call->caller_phone}}</td>
                    <td>{{ $call->address }}</td>
                    <td>{{ $call->info }}</td>
                    <td>
                        @switch($call->status)
                            @case('Waiting')
                                <span class="badge rounded-pill text-bg-success">Waiting</span>
                                @break
                            @case('Finished')
                                <span class="badge rounded-pill text-bg-secondary">Finished</span>
                                @break
                            @case('On hold')
                                <span class="badge rounded-pill text-bg-warning">On hold</span>
                                @break
                        @endswitch
                    </td>
                    <td><a href="{{route('calls.edit', ['call' => $call->id])}}" class="btn btn-primary btn-sm text-white">Edit</a></td>
                    <td>
                        <delete-button csrf="{{csrf_token()}}" action="{{route('calls.destroy', ['call' => $call->id])}}"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $calls->links() }}
    @endif
@endsection