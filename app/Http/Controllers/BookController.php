<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Option;
use App\Role;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;


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
        $cats = Category::paginate(10);
        return view('admin.category', compact('cats'));
    }

    public function create()
    {

        $categorys = Category::pluck('name', 'id')->toArray();
        return view('admin.bookcreate', compact('categorys'));
    }

    public function store(Request $request)
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
        $file = request()->file('image');
        $img = Image::make($file->getPathname())
            ->resize(600, 400)
            ->save('./uploads/' . $lastbook->id . '_' . $file->getClientOriginalName());
        $book->photo = $lastbook->id . '_' . $file->getClientOriginalName();
        $book->save();
        return redirect('/admin/book/');
    }

    public function edit($book_id)
    {
        $data = [
            'book' => Book::find($book_id)
        ];
        $categorys = Category::pluck('name', 'id')->toArray();
        return view('admin.bookedit', $data, compact('categorys'));
    }

    public function update($book_id, Request $request)
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

        if (!empty($request->file())) {
            $file = request()->file('image');
            $img = Image::make($file->getPathname())
                ->resize(600, 400)
                ->save('./uploads/' . $book_id . '_' . $file->getClientOriginalName());
            $book->photo = $book_id . '_' . $file->getClientOriginalName();
            $book->save();
        } else {
            $book->save();
        }
        return redirect('/admin/book/');
    }

    public function destroy($book_id)
    {
        Book::destroy($book_id);
        return redirect('/admin/book/');
    }

    public function registration()
    {
        $cats = new Category();
        $book = new Book();
        $data = [
            'categorys' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1)
        ];
        return view('registration', $data);
    }

    public function index()
    {
        $cats = new Category();
        $book = new Book();
        $data = [
            'categorys' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1)
        ];
        $books = Book::paginate(6);
        return view('main', compact('books'), $data);
    }

    public function product($id)
    {
        Book::findOrFail($id);
        $cats = new Category();
        $book = new Book();
        $cat_id = Book::find($id)->category_id;
        $data = [
            'cat' => Category::find($cat_id),
            'categorys' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1),
            'booksView' => $book->randomBookCount(3),
            'book' => Book::find($id)
        ];
        return view('product', $data);
    }

    public function search()
    {
        $keyword = Input::get('s');
        $cats = new Category();
        $book = new Book();
        $data = [
            'categorys' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1),
            'search' => $keyword
        ];
        $books = Book::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->paginate(6);
        return view('search', compact('books'), $data);
    }

}
