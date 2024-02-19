<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden scroll-smooth group" data-mode="light" dir="ltr">
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
        <div class="mx-auto ">
            <ul id="navbar7"
                class="absolute inset-x-0 z-20 items-center hidden py-3 bg-white shadow-lg dark:bg-zink-600 dark:md:bg-transparent md:z-0 navbar-menu rounded-b-md md:shadow-none md:flex top-full ltr:ml-auto rtl:mr-auto md:relative md:bg-transparent md:rounded-none md:top-auto md:py-0">
                <li>
                    <a href="#"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">Favourites</a>
                </li>
                <li>
                    <a href="#"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">Shop</a>
                </li>
                <li>
                    <a href="#"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">Settings</a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();"
                       class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&.active]:text-custom-500 dark:text-zink-100 dark:hover:text-custom-500 dark:[&.active]:text-custom-500">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
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
<footer class="relative pt-20 pb-12 bg-slate-800 dark:bg-zink-700">
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
        <div class="relative z-10 grid grid-cols-12 gap-5 xl:grid-cols-12">
            <div class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                <h5 class="mb-4 font-medium tracking-wider text-slate-50 dark:text-zink-50">ABOUT US</h5>
                <ul class="flex flex-col gap-3 text-15">
                    <li>
                        <a href="#!"
                           class="relative inline-block transition-all duration-200 ease-linear text-slate-400 dark:text-zink-200 hover:text-slate-300 dark:hover:text-zink-50 before:absolute before:border-b before:border-slate-500 dark:before:border-zink-500 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear">Shop</a>
                    </li>
                    <li>
                        <a href="#!"
                           class="relative inline-block transition-all duration-200 ease-linear text-slate-400 dark:text-zink-200 hover:text-slate-300 dark:hover:text-zink-50 before:absolute before:border-b before:border-slate-500 dark:before:border-zink-500 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear">Favourite</a>
                    </li>
                    <li>
                        <a href="#!"
                           class="relative inline-block transition-all duration-200 ease-linear text-slate-400 dark:text-zink-200 hover:text-slate-300 dark:hover:text-zink-50 before:absolute before:border-b before:border-slate-500 dark:before:border-zink-500 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear">Social
                            Media</a>
                    </li>
                </ul>
            </div><!--end col-->
            <div class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                <h5 class="mb-4 font-medium tracking-wider text-slate-50 dark:text-zink-50">ABOUT US</h5>
                <p class="mb-5 text-lg text-slate-500 dark:text-zinc-400" data-aos="fade-left" data-aos-delay="500">
                    Scan a Memori Medallion to learn about and interact with those who have passed on. You
                    can also begin documenting the legacy you wish leave behind.</p>
                <h5 class="mb-4 font-medium tracking-wider text-slate-50 dark:text-zink-50">3857868641</h5>
                <h5 class="mb-4 font-medium tracking-wider text-slate-50 dark:text-zink-50">info@memori.com
                </h5>
            </div><!--end col-->
            <div class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-2">
                <h5 class="mb-4 font-medium tracking-wider text-slate-50 dark:text-zink-50">Quick Links</h5>
                <ul class="flex flex-col gap-3 text-15">
                    <li>
                        <a href="#!"
                           class="relative inline-block transition-all duration-200 ease-linear text-slate-400 dark:text-zink-200 hover:text-slate-300 dark:hover:text-zink-50 before:absolute before:border-b before:border-slate-500 dark:before:border-zink-500 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear">
                            Home</a>
                    </li>
                    <li>
                        <a href="#!"
                           class="relative inline-block transition-all duration-200 ease-linear text-slate-400 dark:text-zink-200 hover:text-slate-300 dark:hover:text-zink-50 before:absolute before:border-b before:border-slate-500 dark:before:border-zink-500 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear">
                            Shop
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

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
</body>
</html>
