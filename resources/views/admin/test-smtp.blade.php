<x-admin>
    <x-slot name="title">
        {{ __('all.site_settings') }}
    </x-slot>
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div
            class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.8)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                    <div class="grow">
                        <h5 class="text-16">Test SMTP</h5>
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
                <div class="card">
                    <div class="card-body">
                        <div class="p-6 bg-white shadow-md rounded-lg">
                            <h2 class="text-lg font-semibold mb-4">Test SMTP Email</h2>

                            @if (session()->has('success'))
                                <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="p-3 mb-4 text-red-700 bg-red-100 rounded">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form wire:submit.prevent="sendTestEmail">
                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 font-medium">Recipient Email:</label>
                                    <input type="email" id="email" wire:model="email"
                                           class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200">
                                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Send Test Email
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
