<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request): JsonResponse
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Attempt to send the password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // If the reset link was sent successfully, return a success response
        if ($status == Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => __('Password reset link sent successfully.'),
            ], 200);
        }

        // If the status is not successful, throw validation exception
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
