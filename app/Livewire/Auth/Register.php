<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function register(AuthService $authService)
    {
        $this->validate();

        $user = $authService->registerUser([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $authService->loginUser(['email' => $this->email, 'password' => $this->password]);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
