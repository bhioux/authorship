@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($books as $book)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ $book->description }}</p>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary">View Book</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit Book</a>
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
