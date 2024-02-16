<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        if (auth()->user()->role == 'admin') {
            $this->redirect(route('admin.dashboard'));
        } else {
            $this->redirect(
                session('url.intended', RouteServiceProvider::HOME),
            );
        }
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
                        <h4 class="mb-2 text-purple-500 dark:text-purple-500">Welcome Back !</h4>
                        <p class="text-slate-500 dark:text-zink-200">Sign in to continue to Memori.</p>
                    </div>
                    <form wire:submit="login">
                        <div class="mb-3">
                            <x-input-label for="email" class="inline-block mb-2 text-base font-medium"
                                           :value="__('Email')"/>
                            <x-text-input wire:model="form.email"
                                          type="email" required autofocus autocomplete="email"
                                          placeholder="Enter email"/>
                            <x-input-error :messages="$errors->get('email')"/>
                        </div>
                        <div class="mb-3">
                            <x-input-label for="password" class="inline-block mb-2 text-base font-medium"
                                           :value="__('Password')"/>
                            <x-text-input wire:model="form.password" id="password"
                                          type="password" required placeholder="Enter Password"/>
                            <x-input-error :messages="$errors->get('password')"/>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <input id="remember" wire:model="form.remember"
                                       class="w-4 h-4 border rounded-sm appearance-none bg-slate-100 border-slate-200 dark:bg-zink-600/50 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                       type="checkbox" value="">
                                <label for="remember"
                                       class="inline-block text-base font-medium align-middle cursor-pointer">Remember
                                    me</label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit"
                                    class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                Sign In
                            </button>
                        </div>
                        <div class="mt-5 text-center">
                            <a wire:navigate
                               class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                               href="{{ route('password.request') }}" wire:navigate>
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                        <div class="mt-10 text-center">
                            <p class="mb-0 text-slate-500 dark:text-zink-200">Don't have an account ? <a
                                        href="{{route('register')}}" wire:navigate
                                        class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">
                                    SignUp</a></p>
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
