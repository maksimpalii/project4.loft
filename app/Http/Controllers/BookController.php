<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categorie;
use App\Role;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image as Image;

class BookController extends Controller
{
    public function asd()
    {
        $data = ['asd' => 'asd'];
        return view('posts.index', $data);
    }

    public function clearAll($dataIn, $isArray = false)
    {
        if ($isArray === false) {
            $data_ = strip_tags($dataIn);
            $data = htmlspecialchars($data_, ENT_QUOTES);
        } else {
            $data = [];
            foreach ($dataIn as $key => $value) {
                $data[$key] = htmlspecialchars(strip_tags($value), ENT_QUOTES);
            }
        }
        return $data;
    }

    public function adminbook()
    {
        $books = Book::paginate(10);
        return view('admin.book', compact('books'));
    }

    public function admincategory()
    {
        $cats = Categorie::paginate(10);
        return view('admin.category', compact('cats'));
    }

    public function admincreate()
    {

        $categories = Categorie::pluck('name', 'id')->toArray();
        return view('admin.bookcreate', compact('categories'));

       // return view('admin.bookcreate');
    }

    public function adminstore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'required|image'
        ]);

        $test = Book::orderBy('id', 'DESC')->first();
        $book = new Book();
        $book->name = $request->name;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->price = $request->price;


        $file = $_FILES['image'];

        $img = Image::make($file['tmp_name'])
            ->resize(600, 400)
            ->save('./uploads/' . $test->id . '_' . $file['name']);
        $book->photo = $test->id . '_' . $file['name'];
        $book->save();
        return redirect('/admin/book/');
    }

    public function bookedit($book_id)
    {
        $data = [
            'book' => Book::find($book_id)
        ];
        $categories = Categorie::pluck('name', 'id')->toArray();
        return view('admin.bookedit', $data, compact('categories'));
    }

    public function bookupdate($book_id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:10',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'image'
        ]);
        $book = Book::find($book_id);
        $book->name = $request->name;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->price = $request->price;

        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
            $img = Image::make($file['tmp_name'])
                ->resize(600, 400)
                ->save('./uploads/' . $book_id . '_' . $file['name']);
            $book->photo = $book_id . '_' . $file['name'];
            $book->save();
        } else {
            $book->save();
        }


//        $file = $request->file('image');
//        $file->move('.', $file->getClientOriginalName());

        return redirect('/admin/book/');
    }

    public function bookdestroy($book_id)
    {
        Book::destroy($book_id);
        return redirect('/admin/book/');
    }


    public function test()
    {
        return view('test');
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
        //var_dump(Auth::id());


//        echo Auth::user()->name;
//        echo Auth::user()->email;


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

//    public function deleteAvatar()
//    {
//        $routes = explode('/', $_SERVER['REQUEST_URI']);
//        $id = $routes[3];
//        $datas = Users::query()->select('photo')->where('id', '=', $id)->get();
//        $data = $datas->toArray()[0];
//        if ($data !== false) {
//            if (Users::deleteOnlyPhoto($data['photo']) === 'delete') {
//                $user = Users::find($id);
//                $user->photo = '';
//                $user->save();
//                $msg = 'Аватарка удалена';
//            } else {
//                $msg = 'Нет доступа к фото';
//            }
//        } else {
//            $msg = 'Такой аватарки нет';
//        }
//        return $msg;
//    }
//    private function deleteOnlyPhoto($photo)
//    {
//        if (file_exists('photos/' . $photo)) {
//            @unlink('photos/' . $photo);
//            $msg = 'delete';
//        } else {
//            $msg = 'no';
//        }
//        return $msg;
//    }

}
