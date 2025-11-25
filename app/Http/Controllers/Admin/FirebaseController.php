<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FirebaseService;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }
    public function senAll(Request $request) {
        $tokens = User::whereNotNull('device_token')
            ->pluck('device_token')
            ->filter()
            ->values()
            ->toArray();
        if (empty($tokens)) {
            return back()->with('notification', 'No hay tokens de dispositivos disponibles.');

        }
        $response = [];
        foreach ($tokens as $token) {
            $response[] = $this->firebaseService->sendNotification(
                $token,
                $request->input('title'),
                $request->input('body')
            );
        }
        $notification = 'Notificaciones Se envio a todos los pacientes con exito.';
        return back()->with(compact('notification'));
    }
}