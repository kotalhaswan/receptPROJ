@extends('layouts.app')

@push('style')
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="background: gray; color:#f1f7fa; font-weight:bold;">
                            Update Recipe
                            <a href="{{ route('recipes.index') }}" class="btn btn-success btn-xs py-0 float-end">Back</a>
                        </div>
                        @if(session('message'))
                            <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('message') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="w-px-500 p-3 p-md-3" action="{{ route('recipes.update', $recipe->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ $recipe->name }}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Origin</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('origin') is-invalid @enderror" name="origin" placeholder="Origin" value="{{ $recipe->origin }}">
                                        @error('origin')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Ingredients</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('ingredients') is-invalid @enderror" name="ingredients" placeholder="Ingredients" value="{{ $recipe->ingredients }}">
                                        @error('ingredients')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Instructions</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('instructions') is-invalid @enderror" name="instructions" placeholder="Instructions" value="{{ $recipe->instructions }}">
                                        @error('instructions')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-success btn-block text-white">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
