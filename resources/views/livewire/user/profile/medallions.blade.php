<div>
    <div class="{{!$list_screen ? 'hidden' : ''}}">
        <div class="mb-3">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{__('all.profile')}}</h2>
                <button wire:click="showAddScreen()"
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
                    <span>
                        {{ __('all.create_new_profile') }}
                    </span>
                </button>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('all.full_name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('all.relationship') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('all.picture') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('all.qr_code') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('all.edit') }}</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($profiles as $profile)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{route('profile.show',['id' => $profile->id])}}"
                               class="text-custom-500">
                                {{$profile->full_name}}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{$profile->relationship}}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{$profile->profile_picture}}" alt="{{$profile->full_name}}"
                                 class="w-10 h-10 rounded-full">
                        </td>
                        <td class="px-6 py-4">
                            @if($profile->qr_code)
                                <img src="{{$profile->qr_code->image}}" alt="{{$profile->full_name}}"
                                     class="w-12 h-12">
                            @elseif(auth()->user()->hasQRCodes())
                                <a href="#" wire:click="assignQrCode({{$profile->id}})"
                                   class="text-custom-500"
                                   wire:confirm.prompt="Are you sure? This action is irreversable. \n\nType ASSIGN to confirm|ASSIGN">
                                    {{ __('all.assign_available_qr_code') }}
                                </a>
                            @else
                                <a href="{{getShopUrl()}}" target="_blank" class="text-custom-500">
                                    {{ __('all.buy_qr_codes') }}
                                </a>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex">
                                <a href="#" wire:click="showAddScreen({{$profile->id}})"
                                   class="font-medium text-custom-600 dark:text-white-500 hover:underline">
                                    <svg width="28px" height="28px" viewBox="0 0 24.00 24.00" fill="none"
                                         xmlns="http://www.w3.org/2000/svg" transform="rotate(0)">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                           stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z"
                                                  fill="#3b82f6"></path>
                                        </g>
                                    </svg>
                                </a>
                                <a href="#" wire:click="deleteProfile({{$profile->id}})"
                                   wire:confirm.prompt="{{ __('all.confirm_message') }}|DELETE">
                                    <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg" stroke="#fe4848">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                           stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M10 12V17" stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                            <path d="M14 12V17" stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                            <path d="M4 7H20" stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                            <path
                                                d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"
                                                stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                  stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-4" colspan="5">
                            <div class="flex items
                            -center justify-center w-full h-96">
                                <p class="text-gray-500">{{ __('all.no_profiles_found') }}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="{{!$add_screen ? 'hidden' : ''}}">
        <a href="#" wire:click="showListScreen" class="flex mb-5 gap-2">
            <svg fill="#000000" height="25px" width="25px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g
                    id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path id="XMLID_92_"
                          d="M111.213,165.004L250.607,25.607c5.858-5.858,5.858-15.355,0-21.213c-5.858-5.858-15.355-5.858-21.213,0.001 l-150,150.004C76.58,157.211,75,161.026,75,165.004c0,3.979,1.581,7.794,4.394,10.607l150,149.996 C232.322,328.536,236.161,330,240,330s7.678-1.464,10.607-4.394c5.858-5.858,5.858-15.355,0-21.213L111.213,165.004z"></path>
                </g></svg>
        </a>
        <h4>{{ __('all.create_new_profile') }}</h4>
        <h5 style="font-weight: normal">{{ __('all.personal_details') }}</h5>
        <hr>
        <p class="my-3">
            {{ __('all.profile_creation_help') }}
        </p>
        <form wire:submit.prevent="saveProfile">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{ __('all.whoops') }}</strong>
                    <span class="block sm:inline">{{ __('all.check_form_errors') }}</span>
                    <ul class="mt-3 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-3">
                <div>
                    <label for="first_name" class="inline-block mb-2 text-base font-medium">
                        {{ __('all.first_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="first_name" wire:model="form.first_name"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="middle_name" class="inline-block mb-2 text-base font-medium">
                        {{ __('all.middle_name') }}
                    </label>
                    <input type="text" id="middle_name" wire:model="form.middle_name"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="last_name" class="inline-block mb-2 text-base font-medium">
                        {{ __('all.last_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="last_name" wire:model="form.last_name"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
                <div>
                    <label for="title"
                           class="inline-block mb-2 text-base font-medium">{{ __('all.title') }}</label>
                    <input type="text" id="title" wire:model="form.title"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="relationship">{{ __('all.relationship') }}</label>
                    <select
                        id="relationship"
                        wire:model="form.relationship"
                        class="form-select">
                        <option value="">{{ __('all.open_this_select_menu') }}</option>
                        @foreach(['aunt', 'boyfriend', 'brother', 'cousin', 'daughter', 'father', 'girlfriend', 'granddaughter', 'grandfather', 'grandmother', 'grandson', 'great_grandfather', 'great_grandmother', 'husband', 'mother', 'nephew', 'niece', 'sister', 'son', 'uncle', 'wife'] as $relationship)
                            <option value="{{ $relationship }}">{{ __("all.$relationship") }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
                <div class="relative inline-block group">
                    <label for="text_or_phrase">{{ __('all.profile_picture') }}</label>
                    <div class="flex ">
                        <img src="{{$profile_picture}}"
                             class="h-26 w-28 rounded-full object-cover" alt="Profile Picture"/>
                        <button type="button" x-data=""
                                class=""
                                x-on:click.prevent="$dispatch('open-modal', 'update-profile-avatar')">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path
                                    d="M2 12.5001L3.75159 10.9675C4.66286 10.1702 6.03628 10.2159 6.89249 11.0721L11.1822 15.3618C11.8694 16.0491 12.9512 16.1428 13.7464 15.5839L14.0446 15.3744C15.1888 14.5702 16.7369 14.6634 17.7765 15.599L21 18.5001"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path
                                    d="M18.562 2.9354L18.9791 2.5183C19.6702 1.82723 20.7906 1.82723 21.4817 2.5183C22.1728 3.20937 22.1728 4.32981 21.4817 5.02087L21.0646 5.43797M18.562 2.9354C18.562 2.9354 18.6142 3.82172 19.3962 4.60378C20.1783 5.38583 21.0646 5.43797 21.0646 5.43797M18.562 2.9354L14.7275 6.76995C14.4677 7.02968 14.3379 7.15954 14.2262 7.30273C14.0945 7.47163 13.9815 7.65439 13.8894 7.84776C13.8112 8.01169 13.7532 8.18591 13.637 8.53437L13.2651 9.65M21.0646 5.43797L17.23 9.27253C16.9703 9.53225 16.8405 9.66211 16.6973 9.7738C16.5284 9.90554 16.3456 10.0185 16.1522 10.1106C15.9883 10.1888 15.8141 10.2468 15.4656 10.363L14.35 10.7349M14.35 10.7349L13.6281 10.9755C13.4567 11.0327 13.2676 10.988 13.1398 10.8602C13.012 10.7324 12.9673 10.5433 13.0245 10.3719L13.2651 9.65M14.35 10.7349L13.2651 9.65"
                                    stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            Add
                        </button>
                        <div wire:loading wire:loading.target="saveProfilePhoto">
                            <x-loading/>
                        </div>
                    </div>
                </div>
                <div class="relative inline-block">
                    <label for="text_or_phrase">{{ __('all.cover_photo') }}</label>
                    <div class="flex">
                        <img
                            src="{{$cover_photo}}" style="width: 400px; height: 120px" alt="Cover Photo"/>
                        <button type="button" x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'update-cover-photo')">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path
                                    d="M2 12.5001L3.75159 10.9675C4.66286 10.1702 6.03628 10.2159 6.89249 11.0721L11.1822 15.3618C11.8694 16.0491 12.9512 16.1428 13.7464 15.5839L14.0446 15.3744C15.1888 14.5702 16.7369 14.6634 17.7765 15.599L21 18.5001"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path
                                    d="M18.562 2.9354L18.9791 2.5183C19.6702 1.82723 20.7906 1.82723 21.4817 2.5183C22.1728 3.20937 22.1728 4.32981 21.4817 5.02087L21.0646 5.43797M18.562 2.9354C18.562 2.9354 18.6142 3.82172 19.3962 4.60378C20.1783 5.38583 21.0646 5.43797 21.0646 5.43797M18.562 2.9354L14.7275 6.76995C14.4677 7.02968 14.3379 7.15954 14.2262 7.30273C14.0945 7.47163 13.9815 7.65439 13.8894 7.84776C13.8112 8.01169 13.7532 8.18591 13.637 8.53437L13.2651 9.65M21.0646 5.43797L17.23 9.27253C16.9703 9.53225 16.8405 9.66211 16.6973 9.7738C16.5284 9.90554 16.3456 10.0185 16.1522 10.1106C15.9883 10.1888 15.8141 10.2468 15.4656 10.363L14.35 10.7349M14.35 10.7349L13.6281 10.9755C13.4567 11.0327 13.2676 10.988 13.1398 10.8602C13.012 10.7324 12.9673 10.5433 13.0245 10.3719L13.2651 9.65M14.35 10.7349L13.2651 9.65"
                                    stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            Add
                        </button>
                        <div wire:loading wire:loading.target="saveCoverPhoto">
                            <x-loading/>
                        </div>
                    </div>
                </div>
            </div>
            <h5>{{ __('all.headline_text') }}</h5>
            <hr>
            <div class="my-3">
                <label for="text_or_phrase">{{ __('all.heading_text') }}</label>
                <input type="text" id="text_or_phrase" wire:model="form.heading_text"
                       class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                >
            </div>
            <p>{{ __('all.headline_text_description') }}</p>
            <div class="flex items-center gap-2 my-3">
                <input id="is_include_heading" wire:model="form.include_heading_text"
                       class="border h-4 w-4 rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                       type="checkbox" value="1" checked="">
                <label for="is_include_heading">{{ __('all.do_not_include_headline_text') }}</label>
            </div>
            <h5>{{ __('all.obituary_information') }}</h5>
            <hr>
            <div class="my-3">
                <label for="link_to_obituary">{{ __('all.link_to_obituary') }}</label>
                <input type="text" id="link_to_obituary" wire:model="form.obituary_link"
                       class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                >
            </div>
            <div class="my-3">
                <label for="bio_info">{{ __('all.bio_information') }}</label>
                <textarea
                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    id="bio_info" wire:model="form.bio" rows="3"></textarea>
            </div>
            <h5>{{ __('all.lifetimes') }}</h5>
            <hr>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
                <div>
                    <label for="dob"
                           class="inline-block mb-2 text-base font-medium">
                        {{ __('all.birth_date') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="dob" wire:model="form.date_of_birth"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="dod"
                           class="inline-block mb-2 text-base font-medium">
                        {{ __('all.death_date') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="dod" wire:model="form.date_of_death"
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
                        {{ __('all.city') }}
                    </label>
                    <input type="text" id="city" wire:model="form.city"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="state"
                           class="inline-block mb-2 text-base font-medium">
                        {{ __('all.state') }}
                    </label>
                    <input type="text" id="state" wire:model="form.state"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
            </div>
            <h5>{{ __('all.cemetery_information') }}</h5>
            <hr>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
                <div>
                    <label for="cemetery_name"
                           class="inline-block mb-2 text-base font-medium">
                        {{ __('all.cemetery_name') }}
                    </label>
                    <input type="text" id="cemetery_name" wire:model="form.cemetery_name"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="cemetery_plot"
                           class="inline-block mb-2 text-base font-medium">
                        {{ __('all.cemetery_plot_number') }}
                    </label>
                    <input type="text" id="cemetery_plot" wire:model="form.cemetery_plot"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="cemetery_city"
                           class="inline-block mb-2 text-base font-medium">
                        {{ __('all.cemetery_city') }}
                    </label>
                    <input type="text" id="cemetery_city" wire:model="form.cemetery_city"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="cemetery_state"
                           class="inline-block mb-2 text-base font-medium">
                        {{ __('all.cemetery_state') }}
                    </label>
                    <input type="text" id="cemetery_state" wire:model="form.cemetery_state"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
            </div>
            <div class="my-3">
                    <label for="cemetery_plot_location"
                           class="inline-block mb-2 text-base font-medium">
                        {{ __('all.cemetery_plot_location') }}
                    </label>
                    <div class="flex rounded-lg shadow-sm">
                        <button type="button" style="width: 12%;" x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'maps-modal')"
                                class="bg-slate-100 border-slate-200 py-3 px-4 justify-center items-center text-base font-medium rounded-s-md">
                            {{ __('all.cemetery_set_location') }}
                        </button>
                        <input type="text" id="cemetery_state" wire:model.live="cemetery_plot_location"
                               class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>
            </div>
            <h5>{{ __('all.quote_section') }}</h5>
            <hr>
            <div class="my-3">
                <label for="text_or_phrase" class="inline-block mb-2 text-base font-medium">
                    {{ __('all.text_or_phrase') }}
                </label>
                <textarea
                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    id="text_or_phrase" wire:model="form.quote_text" rows="3"></textarea>
            </div>
            <button type="submit" wire:loading.remove
                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                {{ __('all.save') }}
            </button>
        </form>
        <div wire:loading wire:target="saveProfile">
            <x-loading/>
        </div>
    </div>

    <x-modal name="update-profile-avatar" :show="$errors->isNotEmpty()" focusable max>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('all.change_profile_picture') }}
        </h2>
        <div>
            <div>
                <div wire:ignore class="tf-cropper-root">
                    <div x-data="imageCropper2({
        width: {{ $field1['width'] }},
        height: {{ $field1['height'] }},
        shape: '{{ $field1['shape'] }}',
        fieldKey: '{{ $field1['id'] }}'
    })" x-cloak>
                        <div x-show="!showCroppie && !hasImage">
                            <input type="file"
                                   name="{{ $field1['name'] }}"
                                   accept="image/*"
                                   id="{{ $field1['id'] }}"
                                   class="absolute inset-0 z-5 m-0 p-0 w-full h-full outline-none opacity-0 cursor-pointer"
                                   @if($field1['disabled']) disabled @endif
                                   x-ref="input"
                                   x-on:change="updatePreview()"
                                   x-on:dragover="$el.classList.add('active')"
                                   x-on:dragleave="$el.classList.remove('active')"
                                   x-on:drop="$el.classList.remove('active')">

                            {{-- upload icon --}}
                            <div class="flex flex-col items-center justify-center">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path
                                        d="M2 12.5001L3.75159 10.9675C4.66286 10.1702 6.03628 10.2159 6.89249 11.0721L11.1822 15.3618C11.8694 16.0491 12.9512 16.1428 13.7464 15.5839L14.0446 15.3744C15.1888 14.5702 16.7369 14.6634 17.7765 15.599L21 18.5001"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path
                                        d="M18.562 2.9354L18.9791 2.5183C19.6702 1.82723 20.7906 1.82723 21.4817 2.5183C22.1728 3.20937 22.1728 4.32981 21.4817 5.02087L21.0646 5.43797M18.562 2.9354C18.562 2.9354 18.6142 3.82172 19.3962 4.60378C20.1783 5.38583 21.0646 5.43797 21.0646 5.43797M18.562 2.9354L14.7275 6.76995C14.4677 7.02968 14.3379 7.15954 14.2262 7.30273C14.0945 7.47163 13.9815 7.65439 13.8894 7.84776C13.8112 8.01169 13.7532 8.18591 13.637 8.53437L13.2651 9.65M21.0646 5.43797L17.23 9.27253C16.9703 9.53225 16.8405 9.66211 16.6973 9.7738C16.5284 9.90554 16.3456 10.0185 16.1522 10.1106C15.9883 10.1888 15.8141 10.2468 15.4656 10.363L14.35 10.7349M14.35 10.7349L13.6281 10.9755C13.4567 11.0327 13.2676 10.988 13.1398 10.8602C13.012 10.7324 12.9673 10.5433 13.0245 10.3719L13.2651 9.65M14.35 10.7349L13.2651 9.65"
                                        stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <label for="{{ $field1['id'] }}" class="tf-cropper-drop-zone">
                                    {{ __('all.drag_and_drop_or_select_a_file') }}
                                </label>
                                <p class="tf-cropper-file-info">
                                    {{ __('all.jpg_gif_png_max_size') }}
                                </p>
                                <button type="button" x-on:click.prevent class="tf-cropper-upload">
                                    {{ __('all.upload') }}
                                </button>
                            </div>
                        </div>

                        <div x-show="showCroppie" x-on:click.prevent class="tf-cropper-modal-bg">
                            <div class="tf-cropper-modal">
                                <div>
                                    <div class="m-auto" x-ref="croppie"></div>
                                    <div class="flex justify-center items-center gap-2">
                                        <button type="button" class="text-red-600"
                                                x-on:click.prevent="remove()"><i data-lucide="trash"></i></button>
                                        <button type="button" class="text-custom-600" wire:click="$toggle('profile_picture_changed')"
                                                x-on:click.prevent="saveAvatar()"><i data-lucide="save"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>
    <x-modal name="update-cover-photo" :show="$errors->isNotEmpty()" focusable max>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('all.change_cover_photo') }}
        </h2>
        <div>
            <div>
                <div wire:ignore class="tf-cropper-root">
                    <div x-data="imageCropper2({
        width: {{ $field2['width'] }},
        height: {{ $field2['height'] }},
        shape: '{{ $field2['shape'] }}',
        fieldKey: '{{ $field2['id'] }}'
    })" x-cloak>
                        <div x-show="!showCroppie && !hasImage">
                            <input type="file"
                                   name="{{ $field2['name'] }}"
                                   accept="image/*"
                                   id="{{ $field2['id'] }}"
                                   class="absolute inset-0 z-5 m-0 p-0 w-full h-full outline-none opacity-0 cursor-pointer"
                                   @if($field2['disabled']) disabled @endif
                                   x-ref="input"
                                   x-on:change="updatePreview()"
                                   x-on:dragover="$el.classList.add('active')"
                                   x-on:dragleave="$el.classList.remove('active')"
                                   x-on:drop="$el.classList.remove('active')">

                            {{-- upload icon --}}
                            <div class="flex flex-col items-center justify-center">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path
                                        d="M2 12.5001L3.75159 10.9675C4.66286 10.1702 6.03628 10.2159 6.89249 11.0721L11.1822 15.3618C11.8694 16.0491 12.9512 16.1428 13.7464 15.5839L14.0446 15.3744C15.1888 14.5702 16.7369 14.6634 17.7765 15.599L21 18.5001"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path
                                        d="M18.562 2.9354L18.9791 2.5183C19.6702 1.82723 20.7906 1.82723 21.4817 2.5183C22.1728 3.20937 22.1728 4.32981 21.4817 5.02087L21.0646 5.43797M18.562 2.9354C18.562 2.9354 18.6142 3.82172 19.3962 4.60378C20.1783 5.38583 21.0646 5.43797 21.0646 5.43797M18.562 2.9354L14.7275 6.76995C14.4677 7.02968 14.3379 7.15954 14.2262 7.30273C14.0945 7.47163 13.9815 7.65439 13.8894 7.84776C13.8112 8.01169 13.7532 8.18591 13.637 8.53437L13.2651 9.65M21.0646 5.43797L17.23 9.27253C16.9703 9.53225 16.8405 9.66211 16.6973 9.7738C16.5284 9.90554 16.3456 10.0185 16.1522 10.1106C15.9883 10.1888 15.8141 10.2468 15.4656 10.363L14.35 10.7349M14.35 10.7349L13.6281 10.9755C13.4567 11.0327 13.2676 10.988 13.1398 10.8602C13.012 10.7324 12.9673 10.5433 13.0245 10.3719L13.2651 9.65M14.35 10.7349L13.2651 9.65"
                                        stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <label for="{{ $field2['id'] }}" class="tf-cropper-drop-zone">
                                    {{ __('all.drag_and_drop_or_select_a_file') }}
                                </label>
                                <p class="tf-cropper-file-info">
                                    {{ __('all.jpg_gif_png_max_size') }}
                                </p>
                                <button type="button" x-on:click.prevent class="tf-cropper-upload">
                                    {{ __('all.upload') }}
                                </button>
                            </div>

                        </div>

                        {{-- cropper --}}
                        <div x-show="showCroppie" x-on:click.prevent class="tf-cropper-modal-bg">
                            <div class="tf-cropper-modal">
                                <div>
                                    <div class="m-auto" x-ref="croppie"></div>
                                    <div class="flex justify-center items-center gap-2">
                                        <button type="button" class="text-red-600"
                                                x-on:click.prevent="remove()"><i data-lucide="trash"></i></button>
                                        <button type="button" class="text-custom-600" wire:click="$toggle('cover_photo_changed')"
                                                x-on:click.prevent="saveCover()"><i data-lucide="save"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>

    <x-modal name="maps-modal"  :show="$errors->isNotEmpty()" focusable max>
        <div class="flex flex-row justify-between">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('all.set_plot_location') }}
            </h2>
            <button @click="show = false" class="focus:outline-none" >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </button>
        </div>
        <hr>
        <livewire:user.profile.partials.map-search-box :lat="$lat" :lng="$lng" />
    </x-modal>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageCropper2', (config) => ({
                showCroppie: false,
                hasImage: false,
                originalSrc: config.imageUrl,
                width: config.width,
                height: config.height,
                shape: config.shape,
                fieldKey: config.fieldKey,
                croppie: {},
                init() {
                    this.$nextTick(() => this.initCroppie())
                },
                updatePreview() {
                    let reader, files = this.$refs.input.files
                    reader = new FileReader()
                    reader.onload = (e) => {
                        this.showCroppie = true
                        this.originalSrc = e.target.result
                        this.bindCroppie(e.target.result)
                    }
                    reader.readAsDataURL(files[0])
                },
                initCroppie() {
                    this.croppie = new Croppie(this.$refs.croppie, {
                        viewport: {width: this.width, height: this.height, type: this.shape}, //circle or square
                        boundary: {width: this.width, height: this.height}, //default boundary container
                        showZoomer: true,
                        enableResize: false
                    })
                },
                remove() {
                    this.$refs.input.value = null
                    this.showCroppie = false
                    this.hasImage = false
                    this.$refs.result.src = ""
                    this.$wire.set(this.fieldKey, '')
                },
                saveAvatar() {
                    this.croppie.result({
                        type: "base64",
                        size: "original"
                    }).then((croppedImage) => {
                        // this.$wire.set('profile_picture', croppedImage)
                        Livewire.dispatch('saveProfilePhoto', {'image': croppedImage});
                        this.$dispatch('close-modal', 'update-profile-avatar');
                    })
                },
                saveCover() {
                    this.croppie.result({
                        type: "base64",
                        size: "original"
                    }).then((croppedImage) => {
                        // this.$wire.set('cover_photo', croppedImage)
                        Livewire.dispatch('saveCoverPhoto', {'image': croppedImage});
                        this.$dispatch('close-modal', 'update-cover-photo');
                    })
                },
                bindCroppie(src) { //avoid problems with croppie container not being visible when binding
                    setTimeout(() => {
                        this.croppie.bind({url: src})
                    }, 200)
                }
            }))
        })
    </script>
</div>
