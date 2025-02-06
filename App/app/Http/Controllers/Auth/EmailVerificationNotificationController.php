<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse
    {
        // If the user already has verified email, no need to resend the verification link
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified.',
                'redirect' => route('dashboard'), // Optionally, provide a redirect route
            ], 200);
        }

        // Otherwise, send the email verification notification
        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Verification link has been sent to your email.',
        ], 200);
    }
}
