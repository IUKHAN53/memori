<x-app-layout>
    <section class="relative pb-36 pt-44" id="">
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <div class="grid grid-cols-12 2xl:grid-cols-2">
                <div class="col-span-12 lg:col-span-7 2xl:col-span-1">
                    <h1 class="mb-8 !leading-relaxed md:text-7xl">A better way to <span
                            class="text-7xl text-custom-200">remember</span></h1>
                    <p class="mb-6 text-lg text-slate-500 dark:text-zink-200">To start setting up the medallion, create
                        an account or sign in below.</p>
                    <div class="flex items-center gap-2">
                        <a type="button" href="{{route('register')}}"
                                class="py-2.5 px-6 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                            Register
                        </a>
                        <a type="button" href="{{route('login')}}"
                                class="py-2.5 px-6 text-red-500 bg-white border-red-500 border-dashed btn hover:text-red-500 hover:bg-red-50 hover:border-red-600 focus:text-red-600 focus:bg-red-50 focus:border-red-600 active:text-red-600 active:bg-red-50 active:border-red-600 dark:bg-zink-800 dark:ring-red-400/20 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20 dark:active:bg-red-800/20">
                            <span class="align-middle">Sign In</span>
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block lg:col-span-5 pb-32 2xl:col-span-1">
                    <img src="{{asset('assets/images/bg-landing-page.png')}}" alt="Your Image" class="rounded-md">
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
