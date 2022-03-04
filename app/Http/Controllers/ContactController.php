<?php

namespace App\Http\Controllers;

use App\Mail\ContactedMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:filter', 'max:255'],
            'message' => ['required', 'min:10', 'max:255'],
        ]);

        Mail::to(config('mail.to.address'), config('mail.to.name'))
            ->send(new ContactedMessage($request->email, $request->message));

        return redirect('/')
            ->with('contacted', true);
    }
}
