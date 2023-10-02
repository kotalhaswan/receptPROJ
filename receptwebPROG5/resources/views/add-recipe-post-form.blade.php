@extends('layouts.app')

@section('content')

<body>
  <div class="container mt-4">
  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="card">
    <div class="card-header text-center font-weight-bold">
      Create recipe
    </div>
    <div class="card-body">
      <form name="add-recipe-post-form" id="add-recipe-post-form" method="post" action="{{url('store-form')}}">
       @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="title" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Origin</label>
          <textarea name="Origin" class="form-control" required=""></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Ingredients</label>
          <textarea name="Ingredients" class="form-control" required=""></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Instructions</label>
          <textarea name="Instructions" class="form-control" required=""></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>  
</body>
@endsection