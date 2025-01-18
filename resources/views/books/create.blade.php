@extends('layouts.app')

@section('content')
        <form action="{{ route('books.post') }}" method="post">
            @csrf
          <div class="form-group col-md-6">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-valid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="bio">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="author_id">Author</label>
            <select class="form-control" id="author_id" name="author_id">
              <option>Select Author</option>
              @foreach ($authors as $author)
              <option value="{{ $author->id}}" {{ old('author_id') == $author->id ? 'selected' :''  }}>{{ $author->name }}</option>
              @endforeach
            </select>
            @error('author_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <nav class="navbar fixed-bottom navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('books.list') }}">Books List</a>
        </nav>
@endsection