@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-6">
                <div class="card-body">
                    <h5 class="card-title">{{ $author->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Biodata</h6>
                    <p class="card-text">{{ $author->bio}}.</p>
                    <a href="{{ route('authors.list') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
        <nav class="navbar fixed-bottom navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('authors.create') }}">Create Author</a>
            <a class="navbar-brand" href="{{ route('books.create') }}">Create Book</a>
        </nav>
    </div>
@endsection