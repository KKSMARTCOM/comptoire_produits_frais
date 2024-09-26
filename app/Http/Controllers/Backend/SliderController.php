<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use ImageResize;
use App\Http\Requests\SliderRequest;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action d'accès à la liste des sliders
        activity()
            ->causedBy($user)
            ->withProperties(['menu' => 'Sliders', 'action' => 'Accès à la liste'])
            ->log("{$userName} ({$role}) a accédé à la liste des sliders.");

        //$sliders = Slider::all();
        return view('backend.pages.slider.index');
    }

    public function create()
    {
        return view('backend.pages.slider.edit');
    }

    public function edit($id)
    {

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action d'édition d'un slider
        activity()
            ->causedBy($user)
            ->performedOn($slider)
            ->withProperties(['menu' => 'Sliders', 'action' => 'Édition'])
            ->log("{$userName} ({$role}) a accédé à la modification du slider : {$slider->title}.");

        //$slider = Slider::where('id', $id)->first();
        return view('backend.pages.slider.edit');
    }

    public function store(SliderRequest $request)
    {

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/slider/';
            folderOpen($uploadFolder);
            $imgurl = resimyukle($img, $folderName, $uploadFolder);
        }

        Slider::create([
            'name' => $request->name,
            'content' => $request->content,
            'link' => $request->link,
            'status' => $request->status,
            'image' => $imgurl ?? NULL,
        ]);


        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de création d'un slider
        activity()
            ->causedBy($user)
            ->performedOn($slider)
            ->withProperties(['menu' => 'Sliders', 'action' => 'Création'])
            ->log("{$userName} ({$role}) a créé un slider : {$slider->title}.");

        return back()->withSuccess('Slider created successfully');
        // return $request->all();
    }

    public function update(Request $request, $id)
    {

        $slider = Slider::where('id', $id)->firstOrFail();

        if ($request->hasFile('image')) {
            dosyasil($slider->image);

            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/setting/';
            folderOpen($uploadFolder);
            $imgurl = resimyukle($img, $folderName, $uploadFolder);
        }

        $slider->update([
            'name' => $request->name,
            'content' => $request->content,
            'link' => $request->link,
            'status' => $request->status,
            'image' => $imgurl ?? $slider->image,
        ]);


        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de mise à jour d'un slider
        activity()
            ->causedBy($user)
            ->performedOn($slider)
            ->withProperties(['menu' => 'Sliders', 'action' => 'Mise à jour'])
            ->log("{$userName} ({$role}) a mis à jour le slider : {$slider->title}.");

        return back()->withSuccess('Slider updated successfully');
        // return $request->all();
    }

    public function destroy(Request $request)
    {
        $slider = Slider::where('id', $request->id)->firstOrFail();

        // bu kısmı helper.php dosyasında fonk oluşturuldu
        // if(file_exists($slider->image)){
        //     if(!empty($slider->image)){
        //         unlink($slider->image); // resmi sil
        //     }
        // }

        dosyasil($slider->image);

        $slider->delete();

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de suppression d'un slider
        activity()
            ->causedBy($user)
            ->performedOn($slider)
            ->withProperties(['menu' => 'Sliders', 'action' => 'Suppression'])
            ->log("{$userName} ({$role}) a supprimé le slider : {$sliderTitle}.");

        return response(['error' => false, 'message' => 'Slider deleted successfully']);
    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $updateCheck = $update == "false" ? '0' : '1';
        Slider::where('id', $request->id)->update(['status' => $updateCheck]);
        return response(['error' => false, 'status' => $update]); // ajax kullanıldığı için response kullanıldı.
    }
}
