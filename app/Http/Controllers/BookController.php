<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categorie;
use App\Option;
use App\Role;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{


    public function adminConfig()
    {
        $opt = Option::where('name', '=', 'email')->first();
        return view('admin.config', compact('opt'));
    }

    public function adminConfigStore(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $opt = Option::where('name', '=', 'email')->first();

        if (!empty($opt['name'])) {
            $opt->value = $request->email;
            $opt->save();
        } else {
            $optn = new Option();
            $optn->name = 'email';
            $optn->value = $this->clearAll($request->email);
            $optn->save();
        }

        return redirect('/admin/config');
    }

    public function adminBook()
    {
        $books = Book::paginate(10);
        return view('admin.book', compact('books'));
    }

    public function adminCategory()
    {
        $cats = Categorie::paginate(10);
        return view('admin.category', compact('cats'));
    }

    public function adminBookCreate()
    {

        $categories = Categorie::pluck('name', 'id')->toArray();
        return view('admin.bookcreate', compact('categories'));
    }

    public function adminBookStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'required|image'
        ]);

        $lastbook = Book::orderBy('id', 'DESC')->first();
        $book = new Book();
        $book->name = $this->clearAll($request->name);
        $book->description = $this->clearAll($request->description);
        $book->category_id = $this->clearAll($request->category_id);
        $book->price = $this->clearAll($request->price);
        $file = $_FILES['image'];
        $fl = new FileController();
        $book->photo = $fl->upload($file, $lastbook->id);
        $book->save();
        return redirect('/admin/book/');
    }

    public function adminBookEdit($book_id)
    {
        $data = [
            'book' => Book::find($book_id)
        ];
        $categories = Categorie::pluck('name', 'id')->toArray();
        return view('admin.bookedit', $data, compact('categories'));
    }

    public function adminBookUpdate($book_id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'image'
        ]);
        $book = Book::find($book_id);
        $book->name = $this->clearAll($request->name);
        $book->description = $this->clearAll($request->description);
        $book->category_id = $this->clearAll($request->category_id);
        $book->price = $this->clearAll($request->price);

        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
            $fl = new FileController();
            $book->photo = $fl->upload($file, $book_id);
            $book->save();
        } else {
            $book->save();
        }

        return redirect('/admin/book/');
    }

    public function adminBookDestroy($book_id)
    {
        Book::destroy($book_id);
        return redirect('/admin/book/');
    }

    public function registration()
    {
        $cats = new Categorie();
        $book = new Book();
        $data = [
            'categories' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1)
        ];
        return view('registration', $data);
    }

    public function index()
    {
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
        if (!empty(Book::find($id))) {
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
        } else {
            return redirect('/');
        }
    }

    public function search()
    {
        $keyword = Input::get('s');
        $cats = new Categorie();
        $book = new Book();
        $data = [
            'categories' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1),
            'search' => $keyword
        ];
        $books = Book::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->paginate(6);
        return view('search', compact('books'), $data);
    }

}
