<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use stdClass;

class MailController extends Controller
{
    public function send()
    {
        $objDemo = new stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'SenderUserName';
        $objDemo->receiver = 'ReceiverUserName';
        Mail::to("maksim.palii@gmail.com")->send(new DemoEmail($objDemo));
    }
}
