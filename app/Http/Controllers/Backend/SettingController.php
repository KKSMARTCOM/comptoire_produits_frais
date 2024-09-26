<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action d'accès à la liste des paramètres
        activity()
            ->causedBy($user)
            ->withProperties(['menu' => 'Paramètres', 'action' => 'Accès à la liste'])
            ->log("{$userName} ({$role}) a accédé à la liste des paramètres.");

        //$settings = SiteSetting::get();
        return view('backend.pages.setting.index');
    }

    public function create()
    {
        return view('backend.pages.setting.edit');
    }

    public function store(Request $request)
    {
        $key = $request->name;
        SiteSetting::firstOrCreate(
            [
                'name' => $key,
            ],
            [
                'name' => $key,
                'data' => $request->data,
                'set_type' => $request->set_type
            ]
        );


        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de création d'un paramètre
        activity()
            ->causedBy($user)
            ->performedOn($setting)
            ->withProperties(['menu' => 'Paramètres', 'action' => 'Création'])
            ->log("{$userName} ({$role}) a créé un paramètre : {$setting->name}.");

        return back()->withSuccess('Setting created successfully');
    }

    public function edit($id)
    {
        $setting = SiteSetting::where('id', $id)->first();

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action d'édition d'un paramètre
        activity()
            ->causedBy($user)
            ->performedOn($setting)
            ->withProperties(['menu' => 'Paramètres', 'action' => 'Édition'])
            ->log("{$userName} ({$role}) a accédé à la modification du paramètre : {$setting->name}.");

        return view('backend.pages.setting.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = SiteSetting::where('id', $id)->first();

        $key = $request->name;

        if ($request->hasFile('data')) {
            dosyasil($setting->data);

            $img = $request->file('data');
            $folderName = $key;
            $uploadFolder = 'img/setting/';
            folderOpen($uploadFolder);
            $imgurl = resimyukle($img, $folderName, $uploadFolder);
        }

        if ($request->set_type == 'file' || $request->set_type == 'image') {
            $dataImage = $imgurl ?? $setting->data;
        } else {
            $dataImage = $request->data ?? $setting->data;
        }

        $setting->update(
            [
                'name' => $key,
                'data' => $dataImage,
                'set_type' => $request->set_type
            ]
        );


        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de mise à jour d'un paramètre
        activity()
            ->causedBy($user)
            ->performedOn($setting)
            ->withProperties(['menu' => 'Paramètres', 'action' => 'Mise à jour'])
            ->log("{$userName} ({$role}) a mis à jour le paramètre : {$setting->name}.");

        return back()->withSuccess('Setting updated successfully');
    }

    public function destroy(Request $request)
    {
        $setting = SiteSetting::where('id', $request->id)->firstOrFail();

        dosyasil($setting->data);

        $setting->delete();

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de suppression d'un paramètre
        activity()
            ->causedBy($user)
            ->performedOn($setting)
            ->withProperties(['menu' => 'Paramètres', 'action' => 'Suppression'])
            ->log("{$userName} ({$role}) a supprimé le paramètre : {$settingName}.");

        return response(['error' => false, 'message' => 'Setting deleted successfully']);
    }
}
