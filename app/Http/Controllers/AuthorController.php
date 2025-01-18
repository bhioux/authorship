<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    function index(){
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }
}
