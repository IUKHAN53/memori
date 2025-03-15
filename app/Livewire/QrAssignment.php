<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use App\Models\QrCode;
use App\Models\QrCodeUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

class QrAssignment extends Component
{
    #[Layout('layouts.auth')]
    public LoginForm $form;
    public string $identifier;
    public ?User $user = null;
    public bool $wants_login = true;

    // Register form fields
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount($identifier)
    {
        $this->identifier = $identifier;
        $qrcode = QrCode::where('identifier', $identifier)->first();

        if ($qrcode && $qrcode->is_assigned) {
            return redirect()->route('profile.show', ['id' => $qrcode->profile_id]);
        }

        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.qr-assignment');
    }

    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();
        $this->user = auth()->user();

        $this->dispatch('userLoggedIn');
    }

    public function register()
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        event(new Registered($user));
        Auth::login($user);
        $this->user = $user;

        $this->dispatch('userLoggedIn');
    }

    public function toggleLogin()
    {
        $this->wants_login = !$this->wants_login;
    }

    public function switchAccount()
    {
        Auth::logout();
        $this->user = null;
        $this->wants_login = true;
    }

    public function verifyAndAdd()
    {
        $qrCode = QrCode::where('identifier', $this->identifier)->first();

        if (!$qrCode) {
            $this->addError('qr_code', 'Invalid QR Code');
            return;
        }

        QrCodeUser::create([
            'qr_code_id' => $qrCode->id,
            'user_id' => $this->user->id,
        ]);

        $this->dispatch('qrCodeAdded');
        return redirect()->route('home');
    }
}
