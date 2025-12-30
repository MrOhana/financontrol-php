<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login(AuthService $authService)
    {
        $this->validate();

        if ($authService->loginUser(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return redirect()->intended(route('dashboard'));
        }

        $this->addError('email', 'These credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
