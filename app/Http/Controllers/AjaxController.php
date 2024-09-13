<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContentFormRequest;
use Illuminate\Support\Facades\Mail;

class AjaxController extends Controller
{
    public function contactsave(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|min:2',
            'firstname' => 'required|string|min:2',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ], [
            'lastname.required' => 'Vous devez obligatoirement remplir ce champ',
            'firstname.required' => 'Vous devez obligatoirement remplir ce champ',
            'email.required' => 'Vous devez obligatoirement remplir ce champ',
            'email.email' => 'Vous devez entrez un mail valide',
            'subject.required' => 'Vous devez obligatoirement remplir ce champ',
            'message.required' => 'Vous devez obligatoirement remplir ce champ'
        ]);

        $newData = [
            'lastname' => Str::title($request->lastname),
            'firstname' => Str::title($request->firstname),
            'email' => $request->email,
            'subject' => $request->subject,
            'messages' => $request->message,
            'ip' => $request->ip(),
        ];

        //dd($newData);

        Mail::send(
            'frontend.pages.mails.contact',
            [
                'lastname' => $newData['lastname'],
                'firstname' => $newData['firstname'],
                'email' => $newData['email'],
                'subject' => $newData['subject'],
                'messages' => $newData['messages'],
            ],
            function ($message) {

                $config = config('mail');

                $message->subject("Nouveau message reçu !")
                    ->from($config['from']['address'], $config['from']['name'])
                    ->to('arsenegnanhoungbe@gmail.com');
            }
        );

        return back()->withSuccess('Message envoyé !');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
