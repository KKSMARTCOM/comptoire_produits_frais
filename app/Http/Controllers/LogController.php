<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function someAction()
    {
        $user = Auth::user();

        // Exemple de log avec des informations sur l'utilisateur
        Log::info('Action effectuée', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'action' => 'Some action description',
            'email' => $user->email,
        ]);

        // Logique de l'action ici...
    }

    public function index()
    {
        $logPath = storage_path('logs/laravel.log');
        $logs = [];

        if (File::exists($logPath)) {
            $logFile = File::get($logPath);
            $logLines = explode("\n", $logFile);

            foreach ($logLines as $line) {
                if (preg_match('/\[(.*)\]\s(\w+)\.(\w+):\s(.*)/', $line, $matches)) {
                    // Exemple pour capturer les informations supplémentaires (comme l'utilisateur)
                    if (preg_match('/user_id=(\d+), user_name=(.*), action=(.*), email=(.*)/', $matches[4], $userMatches)) {
                        $logs[] = [
                            'date' => $matches[1],
                            'env' => $matches[2],
                            'level' => $matches[3],
                            'message' => $userMatches[3],
                            'user_id' => $userMatches[1],
                            'user_name' => $userMatches[2],
                            'email' => $userMatches[4],
                        ];
                    } else {
                        $logs[] = [
                            'date' => $matches[1],
                            'env' => $matches[2],
                            'level' => $matches[3],
                            'message' => $matches[4],
                        ];
                    }
                }
            }
        }

        return view('logs.index', compact('logs'));
    }
    
}
