@extends('layouts.app')

@section('content')
        <form action="{{ route('authors.post') }}" method="post">
            @csrf

        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('category_id') is-valid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="bio">Biography</label>
            <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio') }}</textarea>
            @error('bio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <nav class="navbar fixed-bottom navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('authors.list') }}">Authors List</a>
        </nav>
@endsection