<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Title') }}
        </h2>
    </x-slot>
    <section class="relative py-24 xl:py-32" id="">
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-custom-500/10 blur-3xl"></div>
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <img class="w-full rounded h-58"
                         src="https://app.turninghearts.com/rails/active_storage/blobs/redirect/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBaGNSIiwiZXhwIjpudWxsLCJwdXIiOiJibG9iX2lkIn19--669c7006445fb167d8ede819d27ea38150b3a923/image_processing20230718-1-9pyt6g.jpg"
                         alt="">
                    <div class="flex justify-between items-center gap-3 flex-col md:flex-row my-5">
                        <div class="flex justify-start items-center flex-col md:flex-row gap-3">
                            <img src="{{$profile->profile_picture}}"
                                 id="avatarImage" class="h-24 w-24 rounded-full object-cover" alt="Avatar"/>
                            <div>
                                <div class="font-medium text-md">In loving memory of</div>
                                <div class="font-medium text-lg">{{$profile->full_name}}</div>
                                <div class="text-gray-500">
                                    <strong>Lifetime:</strong> {{\Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y')}}
                                    - {{\Carbon\Carbon::parse($profile->date_of_death)->format('d/m/Y')}}
                                    ({{$profile->age}} Yrs)
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-end">
                            <div
                                class="flex gap-2 justify-center lg:justify-end xl:justify-end 2xl:justify-end sm:justify-center md:justify-center">
                                <button
                                    class="px-3 py-2 bg-yellow-500 text-white text-xs rounded shadow flex items-center gap-2">
                                    <svg class="feather feather-share" fill="none" height="24" stroke="currentColor"
                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         viewBox="0 0 24 24"
                                         width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
                                        <polyline points="16 6 12 2 8 6"/>
                                        <line x1="12" x2="12" y1="2" y2="15"/>
                                    </svg>
                                    Share
                                </button>
                                <a href="{{route('mark-favourite',['id' => $profile->id])}}"
                                   class="px-3 py-2 bg-pink-500 text-white text-xs rounded shadow flex items-center gap-2">
                                    <i data-lucide="heart" class="w-5 h-5" style="{{auth()->user()->hasFavourited($profile)?'fill: red;':''}}"></i>
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
                                    Bio
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="photos"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    Photos
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="videos"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    Videos
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="tributes"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    Tributes
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="details"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">
                                    Details
                                </a>
                            </li>
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
                            <div class="hidden tab-pane" id="details">
                                <div class="flex flex-col gap-3">
                                    <h6 class="py-3">Cemetery information</h6>
                                    <!-- Cemetery -->
                                    <div class="flex flex-col md:flex-row gap-3">
                                        <h6>Obituary link:</h6>
                                        <a target="_blank"
                                           href="{{$profile->obituary_link}}"
                                           style="text-decoration: underline;">See obituary </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end card-->
        </div><!--end container-->
    </section><!--end -->

</x-app-layout>
