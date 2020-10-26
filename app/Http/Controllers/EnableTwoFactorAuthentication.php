<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication as Action;

class EnableTwoFactorAuthentication extends Controller
{
    public function __invoke(Request $request, Action $enable)
    {
        $enable($request->user());
        
        return response()->json([
            'view' => view('profile.enabled', [
                'user' => $request->user()
            ])->render(),
        ]);
    }
}
