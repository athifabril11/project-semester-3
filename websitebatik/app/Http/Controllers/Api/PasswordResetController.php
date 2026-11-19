<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Tautan reset password berhasil dikirim. Silakan periksa email Anda.'
            ], 200);
        }

        return response()->json([
            'message' => 'Email tidak ditemukan atau tautan reset gagal dikirim.'
        ], 422);
    }
}
