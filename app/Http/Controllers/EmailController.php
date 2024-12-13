<?php

namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request){
        $toEmail = "paraspurwar5@gmail.com";
        $message = "This is email message.";
        $subject = "This is subject";
        $request = Mail::to($toEmail)->send(new welcomeemail($message,$subject));
        dd($request);
    }
}
