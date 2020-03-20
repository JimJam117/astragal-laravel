<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function index(){
        return view('contact.index');
    }

    public function send() {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        
        

        Mail::send('email', [
            'name' => $data['name'],
            'email' => $data['email'],
            'body' => $data['body'],
        ], function ($message) {
            $message->from('lordpanda1172@gmail.com', 'jsparrow.uk');

            $message->to("jamessparrow101@googlemail.com")->subject("Jsparrow: New Contact");
        });

        $mailSent = $data['name'];

        return redirect()->route('home', ['mailSent' => $mailSent]);
    }
}
