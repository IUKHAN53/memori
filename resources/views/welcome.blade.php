<x-app-layout>

    <section class="relative pb-36 pt-44" id="">
        @if (session('success'))
            <div style="max-width:700px" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative container"
                 role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <div class="grid grid-cols-12 2xl:grid-cols-2">
                <div class="col-span-12 lg:col-span-7 2xl:col-span-1">
                    <h1 class="md:text-7xl">סורקים, מתחברים ומשמרים זיכרונות יקרים</span></h1>
                    <p class="mb-6 text-lg text-slate-500 dark:text-zink-200">כדי לחבר את המדילון שלכם, צרו חשבון או היכנסו למטה.</p>
                    <div class="flex items-center gap-2">
                        <a type="button" href="{{route('register')}}"
                           class="solid-btn py-2.5 px-6 text-white btn">
                            הרשמה
                        </a>
                        <a type="button" href="{{route('login')}}"
                           class="outline-btn py-2.5 px-6 bg-white btn">
                            <span class="align-middle">כניסה</span>
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block lg:col-span-5 pb-32 2xl:col-span-1">
                    <img src="{{asset('assets/images/bg-landing-page.jpg')}}" alt="Your Image" class="rounded-md">
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
