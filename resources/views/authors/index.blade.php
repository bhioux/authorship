@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($authors as $author)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $author->name }}</h5>
                        <p class="card-text">{{ $author->bio }}</p>
                        <div class="btn btn-group">
                            <a href="{{ route('authors.show', $author->id) }}" class="btn btn-secondary">View</a>
                            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('authors.books', $author->id) }}" class="btn btn-success">Books</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <nav class="navbar fixed-bottom navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('authors.create') }}">Create Author</a>
            <a class="navbar-brand" href="{{ route('books.create') }}">Create Book</a>
        </nav>
    </div>
@endsection
