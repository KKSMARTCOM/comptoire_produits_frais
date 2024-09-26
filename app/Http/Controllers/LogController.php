<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index()
    {
        // Récupérer les activités avec le causer (l'utilisateur qui a causé l'action)
        $activities = Activity::with('causer')->latest()->paginate(10);

        // Retourner la vue avec les activités
        return view('logs.index', compact('activities'));
    }
}
