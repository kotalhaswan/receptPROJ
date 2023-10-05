@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($details))
        <p> The Search results for your recipe <b> {{ $query }} </b> are :</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Origin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $user)
            <tr>
                <td>{{$recipes->name}}</td>
                <td>{{$recipes->origin}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection