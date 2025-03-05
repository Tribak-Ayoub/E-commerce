<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): JsonResponse
    {
        // If the user has already verified their email, redirect to the dashboard
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified.',
                'redirect' => route('dashboard'),
            ], 200);
        }

        // Otherwise, prompt for email verification
        return response()->json([
            'message' => 'Please verify your email.',
            'redirect' => route('verification.notice'), // URL to the email verification page
        ], 200);
    }
}
