<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthService
{
    /**
     * Register a new user.
     *
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Laravel uses best available driver (Argon2D/ID if configured)
            'status' => 'ACTIVE',
        ]);

        event(new Registered($user));

        return $user;
    }

    /**
     * Attempt to login a user.
     *
     * @param array $credentials
     * @param bool $remember
     * @return bool
     */
    public function loginUser(array $credentials, bool $remember = false): bool
    {
        if (Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();
            return true;
        }

        return false;
    }

    /**
     * Logout the current user.
     *
     * @return void
     */
    public function logoutUser(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
