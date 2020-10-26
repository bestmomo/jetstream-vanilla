<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeleteAccount extends Controller
{
    public function __invoke(Request $request)
    {
        if (!Hash::check($request->deletePassword, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'deletePassword' => [__('This password does not match our records.')],
            ]);
        }

        Auth::user()->fresh()->delete();

        Auth::logout();

        return response()->json();
    }
}
