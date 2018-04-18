<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categorie;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{


    public function index()
    {
        $cats = new Categorie();
        $book = new Book();
        $data = [
            'categories' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1)
        ];
        if (Auth::user()) {
            $orders = Order::with('books')->where('email', Auth::user()->email)->paginate(4);
            return view('order', compact('orders'), $data);
        } else {
            return view('order', $data);
        }
    }

    public function adminorder()
    {
        $orders = Order::with('books')->paginate(5);
        return view('admin.order', compact('orders'));
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required'
        ]);

        if ($v->fails()) {
//            return 'wrong';
            return $v->errors()->all();
        }


        $post = new Order();
        $post->name = $request->name;
        $post->email = $request->email;
        $post->book_id = $request->book_id;
        $post->save();

        echo 'ok';
        //return redirect('/posts');
    }
}
