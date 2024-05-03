<div>
    <div class="mb-3">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('all.account_settings') }}</h2>
            <button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'update-password')"
                    class="bg-custom-500 hover:bg-custom-800 font-bold py-2 px-4 rounded inline-flex items-center text-white gap-2">
                <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                     viewBox="0 0 45.402 45.402" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier"
                                                                                          stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <path
                                d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141 c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27 c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435 c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path>
                        </g>
                    </g></svg>
                <span>{{ __('all.change_password') }}</span>
            </button>
        </div>
    </div>
    <h5>{{ __('all.personal_details') }}</h5>
    <hr>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
        <div>
            <label for="first_name"
                   class="inline-block mb-2 text-base font-medium">
                {{__('all.first_name')}}
            </label>
            <input type="text" id="first_name" wire:model="first_name"
                   class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
            >
        </div>
        <div>
            <label for="last_name"
                   class="inline-block mb-2 text-base font-medium">
                {{__('all.last_name')}}
            </label>
            <input type="text" id="last_name" wire:model="last_name"
                   class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
            >
        </div>
    </div>
    <h5>{{ __('all.location_details') }}</h5>
    <hr>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
        <div>
            <label for="city"
                   class="inline-block mb-2 text-base font-medium">
                {{__('all.city')}}
            </label>
            <input type="text" id="city" wire:model="city"
                   class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
            >
        </div>
        <div>
            <label for="country"
                   class="inline-block mb-2 text-base font-medium">
                {{__('all.country')}}
            </label>
            <input type="text" id="country" wire:model="country"
                   class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
            >
        </div>
    </div>
    <div class="flex justify-end items-end">
        <button type="submit" wire:click="updateProfile"
                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
            {{ __('all.save_changes') }}
        </button>
    </div>
    <x-action-message class="me-3" on="profile-updated">
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{__('all.profile_updated')}}</span>
        </div>
    </x-action-message>

    <x-modal name="update-password" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="updatePassword" class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('all.change_account_password') }}
            </h2>
            <div>
                <x-input-label for="update_password_current_password" :value="__('all.current_password')" />
                <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="update_password_password" :value="__('all.new_password')" />
                <x-text-input wire:model="password" id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('all.confirm_password')" />
                <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="mt-6 flex justify-end gap-2">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('all.cancel') }}
                </x-secondary-button>

                <button type="submit"
                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                    {{ __('all.change_account_password') }}
                </button>
            </div>
            <x-action-message class="me-3" on="password-updated">
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <span class="font-medium">{{__('all.password_updated')}}</span>
                </div>
            </x-action-message>
        </form>
    </x-modal>

</div>
