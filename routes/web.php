<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Http\Controllers\AuthorController;
use App\Services\ElasticsearchService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/authors', [AuthorController::class, 'index']);

// Route::get('/', function () {
//     return view('authors.list');
// });
Route::get('/', function () {
    $authors = Author::all();
    return view('authors.index', compact('authors'));
})->name('authors.list');

/** START AUTHOR ROUTES */

Route::get('/authors', function () {
    $authors = Author::all();
    return view('authors.index', compact('authors'));
})->name('authors.list');

Route::get('/authors/create', function () {
    return view('authors.create');
})->name('authors.create');

Route::post('/authors', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|max:255',
        'bio' => 'required',
    ]);

    $author = new Author;
    $author->name = $request->name;
    $author->bio = $request->bio;
    $author->save();
    return redirect('/authors')->with('success', 'Author has been created successfully');
})->name('authors.post');

Route::get('/authors/{id}', function ($id) {
    $author = Author::find($id);
    return view('authors.show', compact('author'));
})->name('authors.show');

Route::get('/authors/{id}/edit', function ($id) {
    $author = Author::find($id);
    return view('authors.edit', compact('author'));
})->name('authors.edit');


Route::put('/authors/{id}', function (Request $request, $id) {
    $validated = $request->validate([
        'name' => 'required|max:255',
        'bio' => 'required',
    ]);

    $author = Author::find($id);
    $author->name = $request->name;
    $author->bio = $request->bio;
    $author->save();
    return redirect('/authors')->with('success', 'Author has been created successfully');
})->name('authors.update');

Route::get('/authors/{id}/books', function ($id) {
    $books = Author::find($id)->books;
    return view('authors.books', compact('books'));
})->name('authors.books');

/** END AUTHOR ROUTES */

/** START BOOK ROUTES */

Route::get('/books', function () {
    $books = Book::all();
    return view('books.index', compact('books'));
})->name('books.list');

Route::get('/books/create', function () {
    $authors = Author::all();
    return view('books.create', compact('authors'));
})->name('books.create');

Route::put('/books/{id}', function (Request $request, $id) {
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'author_id' => 'required',
    ]);

    $book = Book::find($id);
    $book->title = $request->title;
    $book->description = $request->description;
    $book->author_id = $request->author_id;
    $book->save();
    return redirect('/books')->with('success', 'Book has been created successfully');
})->name('books.update');

Route::get('/books/{id}', function ($id) {
    $book = Book::find($id);
    return view('books.show', compact('book'));
})->name('books.show');

Route::get('/books/{id}/edit', function ($id) {
    $book = Book::find($id);
    $authors = Author::all();
    return view('books.edit', compact('book', 'authors'));
})->name('books.edit');


Route::post('/books', function (Request $request) {
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'author_id' => 'required',
    ]);

    $book = new Book;
    $book->title = $request->title;
    $book->description = $request->description;
    $book->author_id = $request->author_id;
    $book->save();
    return redirect('/books')->with('success', 'Book has been updated successfully');
})->name('books.post');


Route::get('/search', function (ElasticsearchService $elasticsearch) {
    $query = request('query');

    $results = $elasticsearch->getClient()->search([
        'index' => 'books',
        'body'  => [
            'query' => [
                'multi_match' => [
                    'query'  => $query,
                    'fields' => ['title', 'description'],
                ],
            ],
        ],
    ]);

    return response()->json($results['hits']['hits']);
});

/** END BOOK ROUTES */