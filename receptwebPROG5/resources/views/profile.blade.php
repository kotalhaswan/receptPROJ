@extends('layouts.app')

@section('content')
    <head>
        <title>Edit user profile</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <form
    id="formAccountSettings"
    method="POST"
    action="{{ route('profile.update',auth()->id()) }}"
    enctype="multipart/form-data"
    class="needs-validation"
    role="form"
    novalidate
>
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label">{{ trans('Username')}}</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ auth()->user()->name }}" autofocus="" required>
                <div class="invalid-tooltip">{{ trans('sentence.required')}}</div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">{{ trans('User email')}}</label>
                <input class="form-control" type="text" id="email" name="email" value="{{ auth()->user()->email }}" placeholder="john.doe@example.com">
                <div class="invalid-tooltip">{{ trans('sentence.required')}}</div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success btn-block text-white">{{ trans('Save changes')}}</button>
            </div>
        </div>
    </div>
</form>
    </body>
@endsection
