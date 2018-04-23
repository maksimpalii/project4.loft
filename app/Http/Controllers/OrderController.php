<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Option;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{


    public function index()
    {
        $cats = new Category();
        $book = new Book();
        $data = [
            'categorys' => $cats->catAll(),
            'randomBooks' => $book->getRandomBookCount(1)
        ];
        if (Auth::user()) {
            $orders = Order::with('books')->where('email', Auth::user()->email)->paginate(4);
            return view('order', compact('orders'), $data);
        } else {
            return view('order', $data);
        }
    }

    public function adminOrder()
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
            return $v->errors()->all();
        }

        $order = new Order();
        $order->name = $this->clearAll($request->name);
        $order->email = $this->clearAll($request->email);
        $order->book_id = $this->clearAll($request->book_id);
        $order->save();

        $opt = Option::where('name', '=', 'email')->first();

        if (!empty($opt->value)) {
            $mail = new MailController();
            $mail->sendOrder($request->name, $request->email, $request->book_id, $order->id);
        }

        echo 'ok';
    }
}
