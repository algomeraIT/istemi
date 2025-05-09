<?php

namespace App\Livewire;

use App\Notifications\ChangePassword;
use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
class LoginForm extends Component
{
    public $email;
    public $password;
    public $forgotPasswordEmail = '';
    public $showForgotPassword = false;
    public $showPassword = false;
    public $messageEmail;
    public $messageEmailValid;
    public $messagePassword;

    public function toggleForgotPassword()
    {
        $this->showForgotPassword = !$this->showForgotPassword;
        // Reset fields when toggling
        $this->email = '';
        $this->password = '';
        $this->forgotPasswordEmail = '';
    }

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submit()
    {
        $this->resetValidation();
        $this->messageEmail = null;
        $this->messagePassword = null;

        $validatedData = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            // Separate error messages
            if (!User::where('email', $validatedData['email'])->exists()) {
                $this->messageEmail = "L'email inserita non è registrata.";
            } else {
                $this->messageEmailValid = "Valida";
                $this->messagePassword = "Dati errati, riprova";
            }
            return;
        }
    
        session()->regenerate();
        return redirect()->to('/dashboard');
        }
    



    public function sendResetLink()
    {
        $validatedData = $this->validate([
            'forgotPasswordEmail' => 'required|email'
        ]);

        return User::changeForgottenPassword($validatedData);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.login-form');
    }
}

