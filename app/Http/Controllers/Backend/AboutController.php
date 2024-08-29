<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        //$user = User::where('id',1)->first();
        return view('backend.pages.user.index');
    }

    public function update(Request $request, $id = 1)
    {

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/user/';
            folderOpen($uploadFolder);
            $imgurl = resimyukle($img, $folderName, $uploadFolder);
        }

        $user = User::where('id', $id)->first();

        User::updateOrCreate(
            ['id' => $id], // sorgu kısmı
            [
                'image' => $imgurl ?? $user->image,
                'name' => $request->name,
                'content' => $request->content,
                'text_1_icon' => $request->text_1_icon,
                'text_1' => $request->text_1,
                'text_1_content' => $request->text_1_content,
                'text_2_icon' => $request->text_2_icon,
                'text_2' => $request->text_2,
                'text_2_content' => $request->text_2_content,
                'text_3_icon' => $request->text_3_icon,
                'text_3' => $request->text_3,
                'text_3_content' => $request->text_3_content,
            ] // veritabanına eklenen kısım
        );

        return back()->withSuccess('User updated successfully');
    }

    public function create()
    {
        //$categories = Category::where('cat_ust', null)->get();
        return view('backend.pages.user.edit');
    }

    public function store(UserRequest $request)
    {
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/user/';
            folderOpen($uploadFolder);
            $imgurl = resimyukle($img, $folderName, $uploadFolder);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'image' => $imgurl ?? NULL,
        ]);

        return back()->withSuccess('User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
