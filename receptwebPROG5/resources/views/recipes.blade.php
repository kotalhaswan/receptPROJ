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
           
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Name</th>
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
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</body>
@endsection
</html>
