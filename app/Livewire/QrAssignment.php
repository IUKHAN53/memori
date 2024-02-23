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
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Validation\Rules;

class QrAssignment extends Component
{
    #[Layout('layouts.auth')]
    public LoginForm $form;
    public string $identifier;
    public string $secret_phrase = '';
    public $user;
    public bool $wants_login = true;

//register form
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public function mount($identifier)
    {
        $this->identifier = $identifier;
        $qrcode = QrCode::query()->where('identifier', $identifier)->first();
        if($qrcode->is_assigned){
            return redirect()->route('profile.show', ['id' => $qrcode->profile_id]);
        }
    }

    public function render()
    {
        $this->user = auth()->user();
        return view('livewire.qr-assignment');
    }


    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

    }

    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        event(new Registered($user = User::create($validated)));
        Auth::login($user);
        $this->user = $user;
    }

    public function toggleLogin(): void
    {
        $this->wants_login = !$this->wants_login;
    }

    public function switchAccount(): void
    {
        Auth::logout();
        $this->user = null;
        $this->wants_login = true;
    }

    public function verifyAndAdd()
    {
        $qrCode = QrCode::where('identifier', $this->identifier)->first();
        if ($this->secret_phrase === $qrCode->secret_phrase) {
            QrCodeUser::query()->create([
                'qr_code_id' => $qrCode->id,
                'user_id' => $this->user->id,
            ]);
            return redirect()->route('home');
        }else{
            $this->addError('secret_phrase', 'Invalid secret phrase');
        }
    }

}
