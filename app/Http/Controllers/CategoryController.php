<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id)
    {
        $cats = new Categorie();
        $book = new Book();
        $data = [
            'cat_this' => Categorie::find($id),
            'categories' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1)
        ];

        $books = Book::where('category_id', '=', $id)->paginate(6);
        return view('category', compact('books'), $data);
    }
}
