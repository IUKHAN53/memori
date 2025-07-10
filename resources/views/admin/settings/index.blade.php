<x-admin>
    <x-slot name="title">
        {{ __('all.site_settings') }}
    </x-slot>
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div
            class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                    <div class="grow">
                        <h5 class="text-16">{{ __('all.site_settings') }}</h5>
                    </div>
                    <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                        <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                            <a href="{{ route('admin.dashboard') }}"
                               class="text-slate-400 dark:text-zink-200">{{ __('all.dashboard') }}</a>
                        </li>
                        <li class="text-slate-700 dark:text-zink-100">
                            {{ __('all.site_settings') }}
                        </li>
                    </ul>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <!-- Site Settings Card -->
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.settings.update') }}" method="POST">
                                @csrf
                                <h2 class="text-base font-semibold leading-7 text-gray-900">{{ __('all.settings') }}</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">{{ __('all.settings_description') }}</p>

                                <div class="mt-10">
                                    <label for="language"
                                           class="block text-sm font-medium leading-6 text-gray-900">{{ __('all.language') }}</label>
                                    <select id="language" name="language"
                                            class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 sm:text-sm">
                                        <option disabled selected>{{ __('all.select_language') }}</option>
                                        <option
                                            value="en" {{ ($language && $language->value == 'en') ? 'selected' : '' }}>{{ __('all.english') }}</option>
                                        <option
                                            value="he" {{ ($language && $language->value == 'he') ? 'selected' : '' }}>{{ __('all.hebrew') }}</option>
                                    </select>
                                </div>

                                <div class="mt-5">
                                    <label for="text_direction"
                                           class="block text-sm font-medium leading-6 text-gray-900">{{ __('all.text_direction') }}</label>
                                    <select id="text_direction" name="text_direction"
                                            class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 sm:text-sm">
                                        <option disabled selected>{{ __('all.select_direction') }}</option>
                                        <option
                                            value="rtl" {{ ($textDirection && $textDirection->value == 'rtl') ? 'selected' : '' }}>{{ __('all.rtl') }}</option>
                                        <option
                                            value="ltr" {{ ($textDirection && $textDirection->value == 'ltr') ? 'selected' : '' }}>{{ __('all.ltr') }}</option>
                                    </select>
                                </div>

                                <div class="mt-5">
                                    <label for="shopify_site_url"
                                           class="block text-sm font-medium leading-6 text-gray-900">{{ __('all.shopify_site_url') }}</label>
                                    <input id="shopify_site_url" name="shopify_site_url" type="url"
                                           value="{{ $shopifySiteUrl ? $shopifySiteUrl->value : '' }}"
                                           class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 sm:text-sm">
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <button type="submit"
                                            class="rounded-md bg-custom-600 px-3 py-2 text-sm font-semibold text-white shadow-sm">{{ __('all.save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Test Email SMTP Card -->
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">{{ __('all.test_smtp') }}</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">{{ __('all.test_smtp_description') }}</p>

                            @if (session('success'))
                                <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="p-3 mb-4 text-red-700 bg-red-100 rounded">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.test-smtp.send') }}" method="POST">
                                @csrf
                                <div class="mt-5">
                                    <label for="test_email"
                                           class="block text-sm font-medium leading-6 text-gray-900">{{ __('all.recipient_email') }}</label>
                                    <input id="test_email" name="email" type="email" required
                                           class="block w-full rounded-md border border-gray-300 py-1.5 text-gray-900 sm:text-sm">
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <button type="submit"
                                            class="rounded-md bg-custom-600 px-3 py-2 text-sm font-semibold text-white shadow-sm">Send Test Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
