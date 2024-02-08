<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<x-slot:title>
    Login
    </x-slot>
    <div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
        <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="!px-12 !py-12 card-body">
                    <div class="text-center">
                        <h4 class="mb-2 text-purple-500 dark:text-purple-500">Welcome!</h4>
                        <p class="text-slate-500 dark:text-zink-200">Register to start using Memori.</p>
                    </div>
                    <form wire:submit="register">
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="email" id="email"
                                          type="email" name="email" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')"/>
                        </div>

                        <div class="mb-3">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input wire:model="password" id="password" type="password" name="password"
                                          required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')"/>
                        </div>

                        <div class="mb-3">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')"/>
                        </div>
                        <div class="mt-10">
                            <button type="submit"
                                    class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                Register
                            </button>
                        </div>
                        <div class="mt-10 text-center">
                            <p class="mb-0 text-slate-500 dark:text-zink-200">{{ __('Already registered?') }} <a
                                    href="{{route('login')}}"
                                    wire:navigate
                                    class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">
                                    Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mx-2 mt-2 mb-2 border-none shadow-none lg:col-span-7 card bg-white/60 dark:bg-zink-500/60">
                <div class="!px-10 !pt-10 h-full !pb-0 card-body flex flex-col">
                    <div class="flex items-center justify-between gap-3">
                        <div class="grow">
                            <a href="index-1.html">
                                <img src="{{asset('logo-lg.png')}}" alt="" class="hidden h-6 dark:block">
                                <img src="{{asset('logo-lg.png')}}" alt="" class="block h-6 dark:hidden">
                            </a>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <img src="{{asset('assets/images/img-01.png')}}" alt="" class="md:max-w-[32rem] mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
