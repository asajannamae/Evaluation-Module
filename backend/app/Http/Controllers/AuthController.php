<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role' => ['nullable', 'string'],
            'system' => ['nullable', 'string'],
        ]);

        $normalized = strtolower(trim($data['username']));

        $user = User::query()
            ->whereRaw('LOWER(username) = ?', [$normalized])
            ->orWhereRaw('LOWER(email) = ?', [$normalized])
            ->first();

        if (! $user && str_contains($normalized, '@') === false) {
            $user = User::query()->whereRaw('LOWER(email) = ?', [$normalized.'@local.test'])->first();
        }

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'username' => __('These credentials do not match our records.'),
            ]);
        }

        $token = $user->createToken('evaluation-client')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->username ? (string) $user->username : (string) $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ?? 'Faculty',
                'roleLabel' => $user->role_label ?? 'Panel Member',
                'department' => $user->department ?? 'School of Computer and Information Sciences',
                'position' => $user->position ?? 'Not specified',
                'accountType' => $user->account_type ?? 'Faculty',
                'status' => $user->status ?? 'Active',
                'loginRole' => $data['role'] ?? null,
                'selectedSystem' => $data['system'] ?? null,
            ],
        ]);
    }
}
