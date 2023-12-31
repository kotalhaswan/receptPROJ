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

  <h2 class="text-center">View Recipes</h2>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
  <form action="{{ route('recipes.index') }}" method="GET" role="search">
  <b>Search for recipes by name or origin</b>
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="search"
            placeholder="Search..."> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Recipe name</th>
        <th>Origins</th>
        <th>Ingredients</th>
        <th>Instructions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($recipes as $recipes)
      <tr>
      <td>{{ $recipes->name }}</td>
      <td>{{ $recipes->origin }}</td>
      <td>{{ $recipes->ingredients }}</td>
      <td>{{ $recipes->instructions }}</td>
          <!-- TODO: dit moet een form worden met een method POST/ hidden field _method DELETE method -->
      <td>

          <form action="{{ route('recipes.destroy', $recipes->id) }}" method="POST">
              @csrf
              @method('DELETE')
              @if (Auth::check() && Auth::user()->is_enabled)
                  <button type="submit" class="btn btn-primary btn-sm">DELETE</button>
                      @endif
          </form>
          @if (Auth::check() && Auth::user()->is_enabled)
              <td>
                  <a href="{{ route('recipes.edit', $recipes->id) }}" class="btn btn-primary btn-sm">Edit</a>
              </td>
          @endif
      </tr>
      @endforeach
    </tbody>
  </table>

    @if (Auth::check() && Auth::user()->is_enabled)
        <td><button onclick="location.href='{{ route('recipes.create') }}'">
                Add recipe</button></td>
    @endif

</div>
</body>
@endsection
</html>
