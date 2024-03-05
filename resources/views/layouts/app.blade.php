<!DOCTYPE html>
<html lang="{{getLanguage()}}" class="overflow-x-hidden scroll-smooth group" data-mode="light" dir="{{getDirection()}}">
<head>
    <meta charset="utf-8">
    <title>Memori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Memori, keep the memories alive" name="description">
    <meta content="IUKHAN" name="author">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/tailwind2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css"
          integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg=="
          crossorigin="anonymous" media="print" onload="this.media='all'"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"
            integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig=="
            crossorigin="anonymous"></script>
</head>
<body class="text-base bg-white text-body font-public dark:text-zink-50 dark:bg-zink-800">
<nav
    class="fixed bg-slate-100 inset-x-0 top-0 z-50 flex items-center justify-center h-20 py-3 [&.is-sticky]:bg-white dark:[&.is-sticky]:bg-zink-700 border-b border-slate-200 dark:border-zink-500 [&.is-sticky]:shadow-lg [&.is-sticky]:shadow-slate-200/25 dark:[&.is-sticky]:shadow-zink-500/30 navbar"
    id="navbar">
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto flex items-center self-center w-full">
        <div class="shrink-0">
            <a href="{{route('home')}}">
                <img src="{{asset('logo-lg.png')}}" alt="" class="block h-6 dark:hidden">
                <img src="{{asset('logo-lg.png')}}" alt="" class="hidden h-6 dark:block">
            </a>
        </div>
        <div class="mx-auto">
            <ul id="navbar7"
                class="absolute inset-x-0 z-20 items-center hidden py-3 bg-white shadow-lg dark:bg-zink-600 dark:md:bg-transparent md:z-0 navbar-menu rounded-b-md md:shadow-none md:flex top-full ltr:ml-auto rtl:mr-auto md:relative md:bg-transparent md:rounded-none md:top-auto md:py-0">
                <li>
                    <a href="{{route('home', ['tab' => 'favourites'])}}"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">{{ __('all.favourites') }}</a>
                </li>
                <li>
                    <a href="{{route('home', ['tab' => 'posts'])}}"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">{{ __('all.posts') }}</a>
                </li>
                <li>
                    <a href="{{route('home', ['tab' => 'medallions'])}}"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">{{ __('all.medallions') }}</a>
                </li>
                <li>
                    <a href="{{getShopUrl()}}" target="_blank"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">{{ __('all.shop') }}</a>
                </li>
                <li>
                    <a href="{{route('home', ['tab' => 'settings'])}}"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">{{ __('all.settings') }}</a>
                </li>
                @if(auth()->check())
                    <li class="relative flex items-center dropdown h-header">
                        <button type="button"
                                class="inline-block p-0 transition-all duration-200 ease-linear bg-topbar rounded-full text-topbar-item dropdown-toggle btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200"
                                id="dropdownMenuButton">
                            <div class="bg-pink-100 rounded-full">
                                <img src="{{auth()->user()->picture}}" alt=""
                                     class="w-[37.5px] h-[37.5px] rounded-full">
                            </div>
                        </button>
                        <div
                            class="absolute z-50 p-4 ltr:text-left rtl:text-right bg-white rounded-md shadow-md !top-4 dropdown-menu min-w-[14rem] dark:bg-zink-600 hidden"
                            aria-labelledby="dropdownMenuButton" data-popper-placement="bottom-start"
                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(-168.5px, 55px, 0px);">
                            <h6 class="mb-2 text-sm font-normal text-slate-500 dark:text-zink-300">{{__('all.welcome_message')}}</h6>
                            <a href="#!" class="flex gap-3 mb-3">
                                <div class="relative inline-block shrink-0">
                                    <div class="rounded bg-slate-100 dark:bg-zink-500">
                                        <img
                                            src="{{auth()->user()->picture}}"
                                            alt="" class="w-12 h-12 rounded">
                                    </div>
                                    <span
                                        class="-top-1 ltr:-right-1 rtl:-left-1 absolute w-2.5 h-2.5 bg-green-400 border-2 border-white rounded-full dark:border-zink-600"></span>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-15">{{auth()->user()->name}}</h6>
                                </div>
                            </a>
                            <ul>
                                <li>
                                    <a class="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500"
                                       href="{{route('home', ['tab' => 'settings'])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" data-lucide="user-2"
                                             class="lucide lucide-user-2 inline-block w-4 h-4 ltr:mr-2 rtl:ml-2">
                                            <circle cx="12" cy="8" r="5"></circle>
                                            <path d="M20 21a8 8 0 0 0-16 0"></path>
                                        </svg>
                                        {{ __('all.profile') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500"
                                       href="{{getShopUrl()}}" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" data-lucide="gem"
                                             class="lucide lucide-gem inline-block w-4 h-4 ltr:mr-2 rtl:ml-2">
                                            <path d="M6 3h12l4 6-10 13L2 9Z"></path>
                                            <path d="M11 3 8 9l4 13 4-13-3-6"></path>
                                            <path d="M2 9h20"></path>
                                        </svg>
                                        {{ __('all.shop_for_qr_codes') }}
                                    </a>
                                </li>
                                <li class="pt-2 mt-2 border-t border-slate-200 dark:border-zink-500">
                                    <a onclick="document.getElementById('logout-form').submit();"
                                       class="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500"
                                       href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" data-lucide="log-out"
                                             class="lucide lucide-log-out inline-block w-4 h-4 ltr:mr-2 rtl:ml-2">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" x2="9" y1="12" y2="12"></line>
                                        </svg>
                                        {{ __('all.sign_out') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                @else
                    <li>
                        <a href="{{route('login')}}"
                           class="flex items-center justify-center w-full h-10 px-4 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                            <i data-lucide="log-in"></i>
                            <span class="ml-2">{{ __('all.login') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="flex gap-2">
            <div class="ltr:ml-auto rtl:mr-auto md:hidden navbar-toggale-button">
                <button type="button"
                        class="flex items-center  justify-center w-[37.5px] h-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                    <i data-lucide="menu"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
{{$slot}}

<button id="back-to-top"
        class="fixed flex items-center justify-center w-10 h-10 text-white bg-purple-500 rounded-md bottom-10 right-10">
    <i data-lucide="chevron-up" class="animate animate-icons"></i>
</button>

<script src='{{asset('assets/libs/choices.js/public/assets/scripts/choices.min.js')}}'></script>
<script src="{{asset('assets/libs/%40popperjs/core/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/tippy.js/tippy-bundle.umd.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/prismjs/prism.js')}}"></script>
<script src="{{asset('assets/libs/lucide/umd/lucide.js')}}"></script>
<script src="{{asset('assets/js/tailwick.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/landing-onepage.init.js')}}"></script>
<script>
    function loadFile(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('avatarImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@stack('scripts')
</body>
</html>
