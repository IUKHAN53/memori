<x-admin>
    <x-slot name="title">
        {{ __('all.qr_codes') }}
    </x-slot>
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.8)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                    <div class="grow">
                        <h5 class="text-16">{{ __('all.qr_codes') }}</h5>
                    </div>
                    <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                        <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">{{ __('all.dashboard') }}</a>
                        </li>
                        <li class="text-slate-700 dark:text-zink-100">
                            {{ __('all.manage_profiles') }}
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex justify-between items-center gap-3 md:flex-row flex-col mb-5">
                            <a href="{{route('admin.profiles.create')}}"
                               class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="user-round-plus"></i>
                            </a>
                        </div>
                        <table id="basic_tables" class="display stripe group" style="width:100%">
                            <thead>
                            <tr>
                                <th>{{ __('all.full_name') }}</th>
                                <th>{{ __('all.title') }}</th>
                                <th>{{ __('all.created_by') }}</th>
                                <th>{{ __('all.relationship') }}</th>
                                <th>{{ __('all.birth_date') }}</th>
                                <th>{{ __('all.date_of_death') }}</th>
                                <th>{{ __('all.assigned_qr') }}</th>
                                <th>{{ __('all.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profiles as $profile)
                                <tr>
                                    <td>{{$profile->full_name}}</td>
                                    <td>{{$profile->title}}</td>
                                    <td>{{$profile->user->name}}</td>
                                    <td>{{$profile->relationship}}</td>
                                    <td>{{$profile->date_of_birth}}</td>
                                    <td>{{$profile->date_of_death}}</td>
                                    <td>{{$profile->assignedQr?Storage::url($profile->assignedQr->path):'None'}}</td>
                                    <td>
                                        <div class="flex flex-row gap-2">
                                            <a href="{{route('admin.profiles.edit', $profile->id)}}"
                                               class="text-custom-500 hover:text-custom-600 focus:text-custom-600 dark:text-custom-400 dark:hover:text-custom-500 dark:focus:text-custom-500">
                                                <i data-lucide="edit-3" class="w-5 h-5"></i>
                                            </a>
                                            <form action="{{route('admin.profiles.destroy', $profile->id)}}" method="post" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="text-red-500 hover:text-red-600 focus:text-red-600 dark:text-red-400 dark:hover:text-red-500 dark:focus:text-red-500">
                                                    <i data-lucide="trash" class="w-5 h-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
