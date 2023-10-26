@extends('layouts.app')

@section('content')



    <!DOCTYPE html>

<html lang="en">
<head>
    <title>View Recipes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">

    <h2 class="text-center">Admin page</h2>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $users)
            <tr>
                <td>{{ $users->id }}</td>
                <td>{{ $users->name }}</td>
                <td>{{ $users->email }}</td>
                <td>{{ $users->created_at }}</td>
                @if($users->is_enabled ) <td>Active</td>
                @else
                    <td>Not active</td>
                @endif

                <td><form action="{{ route('enable', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    @if ($users->is_enabled )
                        <button type="submit" class="btn btn-primary btn-sm">Disable</button>
                    @else
                        <button type="submit" class="btn btn-primary btn-sm">Enable</button>
                    @endif

                </form>
                </td>
                <td>
            </tr>

        @endforeach
        </tbody>
    </table>
    <form action="{{ route('majorenable') }}" method="POST">
        @csrf
        @method('PUT')
            <button type="submit" class="btn btn-primary btn-sm">Disable all users</button>
    </form>
</div>
</body>
@endsection
</html>
