<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication as Action;

class DisableTwoFactorAuthentication extends Controller
{
    public function __invoke(Request $request, Action $disable)
    {
        $disable($request->user());

        return response()->json([
            'view' => view('profile.disabled')->render(),
        ]);
    }
}
