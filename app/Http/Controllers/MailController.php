<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use stdClass;

class MailController extends Controller
{
//    public function send()
//    {
//        $objDemo = new stdClass();
//        $objDemo->demo_one = 'Demo One Value';
//        $objDemo->demo_two = 'Demo Two Value';
//        $objDemo->sender = 'SenderUserName';
//        $objDemo->receiver = 'ReceiverUserName';
//        Mail::to("maksim.palii@gmail.com")->send(new DemoEmail($objDemo));
//    }


    public function sendOrder($name, $email, $book_id, $order)
    {
        $mailto = Option::where('name', '=', 'email')->first();

        $objDemo = new stdClass();
        $objDemo->order_number = $order;
        $objDemo->book = $book_id;
        $objDemo->sender = $name;
        $objDemo->receiver = $email;
        Mail::to($mailto->value)->send(new DemoEmail($objDemo));
    }
}
