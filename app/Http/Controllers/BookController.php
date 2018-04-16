<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categorie;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image as Image;

class BookController extends Controller
{
    public function asd()
    {
        $data = ['asd' => 'asd'];
        return view('posts.index', $data);
    }

    public function populate()
    {
        $factory = Factory::create();
//        $cat = ['Action', 'RPG', 'Квесты', 'Онлайн-игры', 'Стратегии'];
//        for ($i = 0; $i < 5; $i++) {
//            $category = new Categorie();
//            $category->name = $cat[$i];
//            $category->description = $factory->text(50);
//            $category->save();
//        }

        for ($i = 0; $i < 30; $i++) {
            $post = new Book();
            $post->name = $factory->jobTitle;
            $post->description = $factory->text(190);
            $post->category_id = rand(1, 5);
            $post->price = rand(100, 800);
            $factory->image($dir = './uploads', $width = 600, $height = 400);
            $post->photo = $factory->image($dir, $width = 600, $height = 400, '', false);
            $post->save();
        }
        return 'Populate';
    }
    public function test()
    {

        return view('test');
    }
    public function index()
    {
        //var_dump(Auth::id());
        //var_dump(Auth::user());
        $user = Auth::user();

       // var_dump($user);

        echo Auth::user()->name;
        echo Auth::user()->email;


        $cats = new Categorie();
        $book = new Book();
        $data = [
            'categories' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1)
        ];
        $books = Book::paginate(6);
        return view('main', compact('books'), $data);
    }

    public function product($id)
    {
        $cats = new Categorie();
        $book = new Book();
        $cat_id = $book->getBookCatId($id);
        $data = [
            'cat' => Categorie::find($cat_id),
            'categories' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1),
            'booksView' => $book->randomBookCount(3),
            'book' => Book::find($id)
        ];
        return view('product', $data);
    }

    public function search($value)
    {
        $cats = new Categorie();
        $book = new Book();
        $data = [
            'categories' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1),
            'search' => $value
        ];
        $books = Book::where('name', 'like', '%'.$value. '%')->orWhere('description', 'like', '%'.$value. '%')->paginate(6);
        return view('search', compact('books'), $data);
    }

}
