<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image as Image;

class AboutController extends Controller
{



    public function index()
    {
        $cats = new Category();
        $book = new Book();
        $data = [
            'categorys' => $cats->catAll(),
            'booksView'=> $book->getRandomBookCount(3),
            'randomBooks' => $book->getRandomBookCount(1)
        ];
        return view('about', $data);
    }


}
