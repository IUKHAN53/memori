<x-admin>
    <x-slot name="title">
        {{ __('all.site_settings') }}
    </x-slot>
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.8)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                    <div class="grow">
                        <h5 class="text-16">{{ __('all.site_settings') }}</h5>
                    </div>
                    <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                        <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">{{ __('all.dashboard') }}</a>
                        </li>
                        <li class="text-slate-700 dark:text-zink-100">
                            {{ __('all.site_settings') }}
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.settings.update')}}" method="POST">
                            @csrf
                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">{{ __('all.settings') }}</h2>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">{{ __('all.settings_description') }}</p>
                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-3 mb-2">
                                            <label for="language"
                                                   class="block text-sm font-medium leading-6 text-gray-900">{{ __('all.language') }}</label>
                                            <div class="mt-2">
                                                <select id="language" name="language" autocomplete="language"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                    <option disabled selected>{{ __('all.select_language') }}</option>
                                                    <option value="en" {{($language && $language->value == 'en' ? 'selected' : '')}}>{{ __('all.english') }}</option>
                                                    <option value="he" {{($language && $language->value == 'he' ? 'selected' : '')}}>{{ __('all.hebrew') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3 mt-5">
                                            <label for="text_direction"
                                                   class="block text-sm font-medium leading-6 text-gray-900">{{ __('all.text_direction') }}</label>
                                            <div class="mt-2">
                                                <select id="text_direction" name="text_direction" autocomplete="country-name"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                    <option disabled selected>{{ __('all.select_direction') }}</option>
                                                    <option value="rtl" {{($textDirection && $textDirection->value == 'rtl' ? 'selected' : '')}}>{{ __('all.rtl') }}</option>
                                                    <option value="ltr" {{($textDirection && $textDirection->value == 'ltr' ? 'selected' : '')}}>{{ __('all.ltr') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3 mt-5">
                                            <label for="shopify_site_url"
                                                   class="block text-sm font-medium leading-6 text-gray-900">{{ __('all.shopify_site_url') }}</label>
                                            <div class="mt-2">
                                                <input id="shopify_site_url" name="shopify_site_url" type="url" autocomplete="shopify_site_url"
                                                       value="{{$shopifySiteUrl ? $shopifySiteUrl->value : ''}}"
                                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-3">
                                <button type="submit" class="rounded-md bg-custom-600 px-3 py-2 text-sm font-semibold text-white shadow-sm">{{ __('all.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
