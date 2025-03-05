<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request)
    // {
    //     $request->authenticate();
    //     $request->session()->regenerate();
    
    //     return response()->json([
    //         'user' => Auth::user(),
    //         'token' => $request->session()->token(), // or generate API token if needed
    //     ]);
    // }
    public function store(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('YourAppName')->plainTextToken; // Create a token

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return response()->json(['message' => 'Logged out successfully']);
    }
    
}
