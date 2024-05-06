<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$profile->full_name }}
        </h2>
    </x-slot>
    <section class="relative py-24 xl:py-32" id="">
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <img class="w-full rounded h-58"
                         src="{{$profile->cover}}"
                         alt="">
                    <div class="flex justify-between items-center gap-3 flex-col md:flex-row my-5">
                        <div class="flex justify-start items-center flex-col md:flex-row gap-3">
                            <img src="{{$profile->profile_picture}}"
                                 id="avatarImage" class="h-24 w-24 rounded-full object-cover" alt="Avatar"/>
                            <div>
                                @if(!$profile->include_heading_text AND $profile->heading_text)
                                    <div
                                        class="font-medium text-md">{{$profile->heading_text ?? ''}}</div>
                                @endif
                                <div class="font-medium text-lg">{{$profile->full_name}}</div>
                                <div class="text-gray-500">
                                    <strong>Lifetime:</strong> {{\Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y')}}
                                    - {{\Carbon\Carbon::parse($profile->date_of_death)->format('d/m/Y')}}
                                    ({{$profile->age}} Yrs)
                                </div>
                                <div>
                                    @if($profile->is_public)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-600">
                                            {{__('all.public_profile')}}
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-600">
                                            {{__('all.private_profile')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-end">
                            <div
                                class="flex gap-2 justify-center lg:justify-end xl:justify-end 2xl:justify-end sm:justify-center md:justify-center">
                                @if(auth()->user()->id == $profile->user_id)
                                    @if($profile->is_public)
                                        <a href="{{route('change-status',['id' => $profile->id])}}"
                                           class="px-3 py-2 bg-red-500 text-white text-xs rounded shadow flex items-center gap-2">
                                            <i data-lucide="eye-off" class="w-5 h-5"></i>
                                            {{__('all.make_private')}}
                                        </a>
                                    @else
                                        <a href="{{route('change-status',['id' => $profile->id])}}"
                                           class="px-3 py-2 bg-custom-500 text-white text-xs rounded shadow flex items-center gap-2">
                                            <i data-lucide="eye" class="w-5 h-5"></i>
                                            {{__('all.make_public')}}
                                        </a>
                                    @endif
                                @endif
                                <button data-modal-target="shareModal"
                                        class="px-3 py-2 bg-yellow-500 text-white text-xs rounded shadow flex items-center gap-2">
                                    <svg class="feather feather-share" fill="none" height="24" stroke="currentColor"
                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         viewBox="0 0 24 24"
                                         width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
                                        <polyline points="16 6 12 2 8 6"/>
                                        <line x1="12" x2="12" y1="2" y2="15"/>
                                    </svg>
                                    {{__('all.share_profile')}}
                                </button>
                                <div id="shareModal" modal-top=""
                                     class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 show">
                                    <div
                                        class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col">
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4">
                                            <div
                                                class="flex items-center justify-between p-2 border-b border-slate-200 dark:border-zink-500">
                                                <h5 class="text-16">Share</h5>
                                                <button data-modal-close="shareModal"
                                                        class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                                                    <i data-lucide="x" class="w-5 h-5"></i></button>
                                            </div>
                                            <div class="flex justify-center w-full items-center gap-4 p-4">
                                                <div class="flex flex-col gap-2 items-center justify-center">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('profile.show', $profile->id)) }}"
                                                       target="_blank">
                                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg"
                                                             x="0px" y="0px" width="50" height="50"
                                                             viewBox="0 0 48 48">
                                                            <path fill="#039be5"
                                                                  d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path>
                                                            <path fill="#fff"
                                                                  d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z"></path>
                                                        </svg>
                                                        <span>Facebook</span>
                                                    </a>
                                                </div>
                                                <div class="flex flex-col gap-2 items-center justify-center">
                                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('profile.show', $profile->id)) }}&text=Check+out+this+profile"
                                                       target="_blank">

                                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg"
                                                             x="0px" y="0px" width="50" height="50"
                                                             viewBox="0 0 50 50">
                                                            <path
                                                                d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z"></path>
                                                        </svg>
                                                        <span>Twitter/X</span>
                                                    </a>
                                                </div>
                                                <div class="flex flex-col gap-2 items-center justify-center">
                                                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('profile.show', $profile->id)) }}&media=&description=Check+out+this+profile"
                                                       target="_blank">
                                                        <svg class="w-8 h-8" width="50" height="50"
                                                             viewBox="0 0 48 48" version="1.1"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="Icons" stroke="none" stroke-width="1"
                                                               fill="none" fill-rule="evenodd">
                                                                <g id="Color-"
                                                                   transform="translate(-300.000000, -260.000000)"
                                                                   fill="#CC2127">
                                                                    <path
                                                                        d="M324.001411,260 C310.747575,260 300,270.744752 300,284.001411 C300,293.826072 305.910037,302.270594 314.368672,305.982007 C314.300935,304.308344 314.357382,302.293173 314.78356,300.469924 C315.246428,298.522491 317.871229,287.393897 317.871229,287.393897 C317.871229,287.393897 317.106368,285.861351 317.106368,283.59499 C317.106368,280.038808 319.169518,277.38296 321.73505,277.38296 C323.91674,277.38296 324.972306,279.022755 324.972306,280.987123 C324.972306,283.180102 323.572411,286.462515 322.852708,289.502205 C322.251543,292.050803 324.128418,294.125243 326.640325,294.125243 C331.187158,294.125243 334.249427,288.285765 334.249427,281.36532 C334.249427,276.10725 330.707356,272.170048 324.263891,272.170048 C316.985006,272.170048 312.449462,277.59746 312.449462,283.659905 C312.449462,285.754101 313.064738,287.227377 314.029988,288.367613 C314.475922,288.895396 314.535191,289.104251 314.374316,289.708238 C314.261422,290.145705 313.996119,291.21256 313.886047,291.633092 C313.725172,292.239901 313.23408,292.460046 312.686541,292.234256 C309.330746,290.865408 307.769977,287.193509 307.769977,283.064385 C307.769977,276.248368 313.519139,268.069148 324.921503,268.069148 C334.085729,268.069148 340.117128,274.704533 340.117128,281.819721 C340.117128,291.235138 334.884459,298.268478 327.165285,298.268478 C324.577174,298.268478 322.138649,296.868584 321.303228,295.279591 C321.303228,295.279591 319.908979,300.808608 319.615452,301.875463 C319.107426,303.724114 318.111131,305.575587 317.199506,307.014994 C319.358617,307.652849 321.63909,308 324.001411,308 C337.255248,308 348,297.255248 348,284.001411 C348,270.744752 337.255248,260 324.001411,260"
                                                                        id="Pinterest">

                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <span>Pinterest</span>
                                                    </a>
                                                </div>
                                                <div class="flex flex-col gap-2 items-center justify-center">
                                                    <a href="https://api.whatsapp.com/send?text=Check+out+this+profile+%3A+{{ urlencode(route('profile.show', $profile->id)) }}"
                                                       target="_blank">
                                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg"
                                                             x="0px" y="0px" width="50" height="50"
                                                             viewBox="0 0 48 48">
                                                            <path fill="#fff"
                                                                  d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"></path>
                                                            <path fill="#fff"
                                                                  d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"></path>
                                                            <path fill="#cfd8dc"
                                                                  d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"></path>
                                                            <path fill="#40c351"
                                                                  d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"></path>
                                                            <path fill="#fff" fill-rule="evenodd"
                                                                  d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z"
                                                                  clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span>WhatsApp</span>
                                                    </a>
                                                </div>
                                                <div class="flex flex-col gap-2 items-center justify-center">
                                                    <a href="mailto:?subject=Check out this profile&body=Check out this profile here: {{ urlencode(route('profile.show', $profile->id)) }}"
                                                       target="_blank">
                                                        <svg class="w-8 h-8" fill="#000000" height="50"
                                                             width="50" version="1.1" id="Layer_1"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                             viewBox="0 0 64 64"
                                                             enable-background="new 0 0 64 64"
                                                             xml:space="preserve">
                                                                    <path id="Mail" d="M58.0034485,8H5.9965506c-3.3136795,0-5.9999995,2.6862001-5.9999995,6v36c0,3.3137016,2.6863203,6,5.9999995,6
                                                                        h52.006897c3.3137016,0,6-2.6862984,6-6V14C64.0034485,10.6862001,61.3171501,8,58.0034485,8z M62.0034485,49.1108017
                                                                        L43.084549,30.1919994l18.9188995-12.0555992V49.1108017z M5.9965506,10h52.006897c2.2056007,0,4,1.7943001,4,4v1.7664003
                                                                        L34.4677505,33.3134003c-1.4902,0.9492989-3.3935013,0.9199982-4.8495998-0.0703011L1.9965508,14.4694996V14
                                                                        C1.9965508,11.7943001,3.7910507,10,5.9965506,10z M1.9965508,16.8852005L21.182251,29.9251003L1.9965508,49.1108017V16.8852005z
                                                                         M58.0034485,54H5.9965506c-1.6473999,0-3.0638998-1.0021019-3.6760998-2.4278984l20.5199013-20.5200024l5.6547985,3.843401
                                                                        c1.0859013,0.7383003,2.3418007,1.1083984,3.5995998,1.1083984c1.1953011,0,2.3925018-0.3339996,3.4463005-1.0048981
                                                                        l5.8423996-3.7230015l20.2961006,20.2961025C61.0673485,52.9978981,59.6508713,54,58.0034485,54z"/>
                                                                    </svg>
                                                        <span>Email</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="text" id="inputText"
                                                       value="{{route('profile.show', $profile->id)}}"
                                                       class="ltr:rounded-r-none rtl:rounded-l-none form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                       placeholder="" readonly>
                                                <button id="copyButton"
                                                        class="inline-block px-3 py-2 border border-l-0 border-slate-200 bg-slate-100 dark:border-zink-500 dark:bg-zink-600 ltr:rounded-r-md rtl:rounded-l-md">
                                                    Copy
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('mark-favourite',['id' => $profile->id])}}"
                                   class="px-3 py-2 bg-pink-500 text-white text-xs rounded shadow flex items-center gap-2">
                                    <i data-lucide="heart" class="w-5 h-5"
                                       style="{{auth()->user()->hasFavourited($profile)?'fill: red;':''}}"></i>
                                    {{auth()->user()->hasFavourited($profile)?'Favourited':'Favourite'}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <ul class="flex flex-wrap justify-center w-full text-sm font-medium text-center border-b border-slate-200 dark:border-zink-500 nav-tabs">
                            <li class="group active">
                                <a href="javascript:void(0);" data-tab-toggle data-target="bio"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    {{__('all.bio')}}
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="photos"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    {{__('all.photos')}}
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="videos"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    {{__('all.videos')}}
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="tributes"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    {{__('all.tributes')}}
                                </a>
                            </li>
                            @if(auth()->user()->id == $profile->user_id)
                                <li class="group">
                                    <a href="javascript:void(0);" data-tab-toggle data-target="profile-users"
                                       class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                        {{__('all.users')}}
                                    </a>
                                </li>
                            @endif
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="details"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    {{__('all.details')}}
                                </a>
                            </li>
                            {{--                            @if( auth()->user()->id == $profile->user_id)--}}
                            {{--                                <li class="group">--}}
                            {{--                                    <a href="javascript:void(0);" data-tab-toggle data-target="admin_settings"--}}
                            {{--                                       class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">--}}
                            {{--                                        {{__('all.Admins')}}--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endif--}}
                        </ul>

                        <div class="mt-5 tab-content">
                            <div class="block tab-pane" id="bio">
                                <div class="flex flex-col gap-3">
                                    {!! $profile->bio !!}
                                </div>
                            </div>
                            <div class="hidden tab-pane" id="photos">
                                <livewire:account.photos :profile="$profile"/>
                            </div>
                            <div class="hidden tab-pane" id="videos">
                                <livewire:account.videos :profile="$profile"/>
                            </div>
                            <div class="hidden tab-pane" id="tributes">
                                <livewire:account.tributes :profile="$profile"/>
                            </div>
                            @if(auth()->user()->id == $profile->user_id)
                                <div class="hidden tab-pane" id="profile-users">
                                    <livewire:account.users :profile="$profile"/>
                                </div>
                            @endif
                            <div class="hidden tab-pane" id="details">
                                <div class="flex flex-col gap-3">
                                    <h6 class="py-3">{{__('all.cemetery_information')}}</h6>
                                    <div class="flex flex-col md:flex-row gap-3">
                                        <h6>{{__('all.cemetery_address')}}:</h6>
                                        <p>{{$profile->cemetery_address}}</p>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-3">
                                        <div>
                                            <h6{{__('all.obituary_link')}}</h6>
                                            <a target="_blank"
                                               href="{{$profile->obituary_link}}"
                                               style="text-decoration: underline;">{{__('all.see_obituary')}}</a>
                                        </div>
                                    </div>
                                    @if($profile->cemetery_lat)
                                        <div>
                                            <iframe width='100%' height='400px' frameborder='0' style='border:0'
                                                    src='https://www.google.com/maps?q={{$profile->cemetery_lat}},{{$profile->cemetery_lng}}&hl=es;z=14&amp;output=embed'
                                                    allowfullscreen></iframe>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('copyButton').addEventListener('click', function () {
            let copyText = document.getElementById('inputText');
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
        });
    </script>

</x-app-layout>
