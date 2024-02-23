<x-slot:title>
    Login
    </x-slot>

    <div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70"  x-data="{ modelOpen: false }">
        <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="!px-12 !py-12 card-body">
                    <div class="text-center">
                        <h4 class="mb-2 text-purple-500 dark:text-purple-500">Welcome Back !</h4>
                        <p class="text-slate-500 dark:text-zink-200">{{$user ? 'Do you want to add QR code to your account' : 'Sign in to add QR code to your account.'}}</p>
                    </div>
                    @if($user)
                        <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden my-4">
                            <img class="w-full h-40 object-cover object-center" src="{{$user->picture}}"
                                 alt="avatar">
                            <div class="py-4 px-6">
                                <h1 class="text-2xl font-semibold text-gray-800">{{$user->name}}</h1>
                                <div class="flex items-center mt-4 text-gray-700">
                                    <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                                        <path
                                            d="M437.332 80H74.668C51.199 80 32 99.198 32 122.667v266.666C32 412.802 51.199 432 74.668 432h362.664C460.801 432 480 412.802 480 389.333V122.667C480 99.198 460.801 80 437.332 80zM432 170.667L256 288 80 170.667V128l176 117.333L432 128v42.667z"/>
                                    </svg>
                                    <h1 class="px-2 text-sm">{{$user->email}}</h1>
                                </div>
                                <div class="flex items flex-col center justify-center gap-2 p-4">
                                    <a href="#" wire:click="switchAccount"
                                       class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        Switch Account
                                    </a>
                                    <a href="#" @click="modelOpen =!modelOpen"
                                       class="w-full text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        Add QR Code
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        @if($wants_login)
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
                                <div class="mt-10 text-center">
                                    <p class="mb-0 text-slate-500 dark:text-zink-200">Don't have an account ? <a
                                            href="#"
                                            wire:click="toggleLogin"
                                            class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">
                                            SignUp</a></p>
                                </div>
                            </form>
                        @else
                            <form wire:submit="register">
                                <div class="mb-3">
                                    <x-input-label for="first_name" :value="__('First Name')"/>
                                    <x-text-input wire:model="first_name" id="first_name" type="text" name="first_name"
                                                  required autofocus
                                                  autocomplete="first_name"/>
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
                                </div>
                                <div class="mb-3">
                                    <x-input-label for="last_name" :value="__('Last Name')"/>
                                    <x-text-input wire:model="last_name" id="last_name" type="text" name="last_name"
                                                  required autofocus
                                                  autocomplete="last_name"/>
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="email" :value="__('Email')"/>
                                    <x-text-input wire:model="email" id="email"
                                                  type="email" name="email" required autocomplete="email"/>
                                    <x-input-error :messages="$errors->get('email')"/>
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="password" :value="__('Password')"/>

                                    <x-text-input wire:model="password" id="password" type="password" name="password"
                                                  required autocomplete="new-password"/>
                                    <x-input-error :messages="$errors->get('password')"/>
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
                                    <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                                  class="block mt-1 w-full"
                                                  type="password"
                                                  name="password_confirmation" required autocomplete="new-password"/>
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
                                            href="#"
                                            wire:click="toggleLogin"
                                            class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">
                                            Login</a></p>
                                </div>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
            <div class="mx-2 mt-2 mb-2 border-none shadow-none lg:col-span-7 card bg-white/60 dark:bg-zink-500/60">
                <div class="!px-10 !pt-10 h-full !pb-0 card-body flex flex-col">
                    <div class="flex items-center justify-between gap-3">
                        <div class="grow">
                            <a href="#">
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

        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
             aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true">
                </div>

                <!-- Modal -->
                <div x-cloak x-show="modelOpen"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-50 max-w-xl p-8 my-8 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                >
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Enter Secret Phrase</h1>
                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </button>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 ">
                        Enter the secret phrase sent to you when purchasing the QR code.
                    </p>
                    <form class="mt-5">
                        <div>
                            <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                                Secret Phrase
                            </label>
                            <input placeholder="Secret Phrase" type="password" wire:model="secret_phrase"
                                   class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                            @error('secret_phrase') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="button" wire:click="verifyAndAdd"
                                    class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-custom-500 rounded-md dark:bg-custom-600 dark:hover:bg-custom-700 dark:focus:bg-custom-700 hover:bg-custom-600 focus:outline-none focus:bg-custom-500 focus:ring focus:ring-custom-300 focus:ring-opacity-50">
                                Verify and Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
