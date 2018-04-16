<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categorie;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image as Image;

class AboutController extends Controller
{



    public function index()
    {
        $cats = new Categorie();
        $book = new Book();
        $data = [
            'categories' => $cats->catAll(),
            'booksView'=> $book->randomBookCount(3),
            'randomBooks' => $book->randomBookCount(1)
        ];
        return view('about', $data);
    }


}
