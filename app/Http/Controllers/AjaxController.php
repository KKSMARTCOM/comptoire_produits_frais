<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContentFormRequest;

class AjaxController extends Controller
{
    public function contactsave(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|min:2',
            'firstname' => 'required|string|min:2',
            'subject' => 'required|string',
            'message' => 'required|string'
        ], [
            'lastname.required' => 'Vous devez obligatoirement remplir ce champ',
            'firstname.required' => 'Vous devez obligatoirement remplir ce champ',
            'subject.required' => 'Vous devez obligatoirement remplir ce champ',
            'message.required' => 'Vous devez obligatoirement remplir ce champ'
        ]);

        $newData = [
            'lastname' => Str::title($request->lastname),
            'firstname' => Str::title($request->firstname),
            'subject' => $request->subject,
            'message' => $request->message,
            'ip' => $request->ip(),
        ];

        return back()->withSuccess('Message envoyé !');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
