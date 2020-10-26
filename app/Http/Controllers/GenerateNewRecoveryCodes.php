<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes as Action;

class GenerateNewRecoveryCodes extends Controller
{
    public function __invoke(Request $request, Action $enable)
    {
        $enable($request->user());

        return response()->json([
            'view' => view('profile.codes', [
                'user' => $request->user()])->render(),
        ]);
    }
}
