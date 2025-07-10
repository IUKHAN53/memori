<x-slot:title>
    {{ __('all.verify_qr') }}
</x-slot:title>

<div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
    <div class="grid-cols-1 gap-0 lg:grid-cols-12">
        <div class="lg:col-span-5">
            <div class="card-body">
                <div class="text-center">
                    <h3 class="mb-2 text-purple-500 dark:text-purple-500">חיבור קוד QR</h3>
                    <p class="text-slate-500 dark:text-zink-200">
                        {{ $user ? __('all.add_qr_to_account') : __('all.sign_in_to_add_qr') }}
                    </p>
                </div>
                @if($user)
                    <div class="max-w-sm bg-white overflow-hidden my-4"
                         style="border: solid 1px #eeeeee; border-radius: 20px;">
                        <img class="w-full h-40 object-contain object-center" style="padding: 1rem 1rem 0 1rem;"
                             src="{{ $user->picture }}"
                             alt="avatar">
                        <div class="py-4 px-4">
                            <h1 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h1>
                            <div class="flex items-center mt-4 text-gray-700" style="margin-bottom: 1rem;">
                                <svg class="fill-current" viewBox="0 0 512 512" style="width: 18px; height: auto;">
                                    <path
                                        d="M437.332 80H74.668C51.199 80 32 99.198 32 122.667v266.666C32 412.802 51.199 432 74.668 432h362.664C460.801 432 480 412.802 480 389.333V122.667C480 99.198 460.801 80 437.332 80zM432 170.667L256 288 80 170.667V128l176 117.333L432 128v42.667z"/>
                                </svg>
                                <h1 class="px-2 text-sm" style="font-weight: 400;">{{ $user->email }}</h1>
                            </div>
                            <div class="flex flex-col items-center justify-center gap-2">
                                <!-- Directly assign QR without secret phrase -->
                                <a href="#" wire:click="verifyAndAdd"
                                   class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    {{ __('all.add_qr_code') }}
                                </a>
                                <a href="#" wire:click="switchAccount"
                                   class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    {{ __('all.switch_account') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    @if($wants_login)
                        <form wire:submit="login">
                            <div class="mb-3">
                                <x-input-label for="email" class="inline-block mb-2 text-base font-medium"
                                               :value="__('all.email')"/>
                                <x-text-input wire:model="form.email" type="email" required autofocus
                                              autocomplete="email"
                                              placeholder="{{ __('all.enter_email') }}"/>
                                <x-input-error :messages="$errors->get('email')"/>
                            </div>
                            <div class="mb-3">
                                <x-input-label for="password" class="inline-block mb-2 text-base font-medium"
                                               :value="__('all.password')"/>
                                <x-text-input wire:model="form.password" id="password" type="password" required
                                              placeholder="{{ __('all.enter_password') }}"/>
                                <x-input-error :messages="$errors->get('password')"/>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <input id="remember" wire:model="form.remember"
                                           class="w-4 h-4 border rounded-sm appearance-none bg-slate-100 border-slate-200 dark:bg-zink-600/50 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                           type="checkbox" value="">
                                    <label for="remember"
                                           class="inline-block text-base font-medium align-middle cursor-pointer">{{ __('all.remember_me') }}</label>
                                </div>
                            </div>
                            <div class="mt-10">
                                <button type="submit"
                                        class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    {{ __('all.sign_in') }}
                                </button>
                            </div>
                            <div class="mt-10 text-center">
                                <p class="mb-0 text-slate-500 dark:text-zink-200">{{ __('all.dont_have_account') }} <a
                                        href="#"
                                        wire:click="toggleLogin"
                                        class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">{{ __('all.sign_up') }}</a>
                                </p>
                            </div>
                        </form>
                    @else
                        <form wire:submit="register">
                            <div class="mb-3">
                                <x-input-label for="first_name" :value="__('all.first_name')"/>
                                <x-text-input wire:model="first_name" id="first_name" type="text" name="first_name"
                                              required
                                              autofocus autocomplete="first_name"/>
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
                            </div>
                            <div class="mb-3">
                                <x-input-label for="last_name" :value="__('all.last_name')"/>
                                <x-text-input wire:model="last_name" id="last_name" type="text" name="last_name"
                                              required autofocus
                                              autocomplete="last_name"/>
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                            </div>

                            <div class="mb-3">
                                <x-input-label for="email" :value="__('all.email')"/>
                                <x-text-input wire:model="email" id="email" type="email" name="email" required
                                              autocomplete="email"/>
                                <x-input-error :messages="$errors->get('email')"/>
                            </div>

                            <div class="mb-3">
                                <x-input-label for="password" :value="__('all.password')"/>
                                <x-text-input wire:model="password" id="password" type="password" name="password"
                                              required
                                              autocomplete="new-password"/>
                                <x-input-error :messages="$errors->get('password')"/>
                            </div>

                            <div class="mb-3">
                                <x-input-label for="password_confirmation" :value="__('all.confirm_password')"/>
                                <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                              type="password"
                                              name="password_confirmation" required autocomplete="new-password"/>
                                <x-input-error :messages="$errors->get('password_confirmation')"/>
                            </div>
                            <div class="mt-10">
                                <button type="submit"
                                        class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    {{ __('all.register') }}
                                </button>
                            </div>
                            <div class="mt-10 text-center">
                                <p class="mb-0 text-slate-500 dark:text-zink-200">{{ __('all.already_registered') }} <a
                                        href="#"
                                        wire:click="toggleLogin"
                                        class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">{{ __('all.login') }}</a>
                                </p>
                            </div>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
