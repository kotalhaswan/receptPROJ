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
  <form action="{{ route('recipes.index') }}" method="GET" role="search">
  <b>Zoek recepten</b>
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="search"
            placeholder="Search recipes"> <span class="input-group-btn">
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
{{--          <a href = '/recipes/delete/{{ $recipes->id }}'>Delete</a>--}}
          <form action="{{ route('recipes.destroy', $recipes->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit">DELETE</button>
          </form>
      </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <td><button onclick="location.href='{{ route('recipes.create') }}'">
     Add recipe</button></td>


</div>
</body>
@endsection
</html>
