<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view (no longer using Inertia).
     * 
     * Instead of returning an Inertia view, you can return a simple JSON response or
     * leave this endpoint if you are rendering it with Vue.
     */
    public function show(): JsonResponse
    {
        // If you need to return some data, you can do so here
        return response()->json([
            'message' => 'Confirm your password to continue.',
        ]);
    }

    /**
     * Confirm the user's password (use API response for this action).
     */
    public function store(Request $request): JsonResponse
    {
        // Validate the password to confirm
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            // Return a JSON error if password is incorrect
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        // Store the password confirmation timestamp in the session
        $request->session()->put('auth.password_confirmed_at', time());

        // Respond with a success message or redirect logic as needed
        return response()->json([
            'message' => 'Password confirmed successfully.',
            'redirect' => route('dashboard'),
        ]);
    }
}
