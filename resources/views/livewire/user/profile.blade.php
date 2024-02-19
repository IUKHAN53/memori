<div>
    <section class="relative py-24 xl:py-32" id="">
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-custom-500/10 blur-3xl"></div>
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-6 mt-20 md:grid-cols-2 mb-5">
                        <div class="flex justify-start items-center flex-col md:flex-row gap-3">
                            <div class="relative inline-block">
                                <img
                                    src="https://st3.depositphotos.com/9998432/13335/v/450/depositphotos_133352156-stock-illustration-default-placeholder-profile-icon.jpg"
                                    class="h-24 w-24 rounded-full object-cover" alt="Avatar"/>
                                <label for="imageUpload" x-data=""
                                       x-on:click.prevent="$dispatch('open-modal', 'update-profile-image')"
                                       class="absolute bottom-0 right-0 bg-blue-600 rounded-full p-1 cursor-pointer bg-white border shadow">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                        <path
                                            d="M2 12.5001L3.75159 10.9675C4.66286 10.1702 6.03628 10.2159 6.89249 11.0721L11.1822 15.3618C11.8694 16.0491 12.9512 16.1428 13.7464 15.5839L14.0446 15.3744C15.1888 14.5702 16.7369 14.6634 17.7765 15.599L21 18.5001"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                        <path
                                            d="M18.562 2.9354L18.9791 2.5183C19.6702 1.82723 20.7906 1.82723 21.4817 2.5183C22.1728 3.20937 22.1728 4.32981 21.4817 5.02087L21.0646 5.43797M18.562 2.9354C18.562 2.9354 18.6142 3.82172 19.3962 4.60378C20.1783 5.38583 21.0646 5.43797 21.0646 5.43797M18.562 2.9354L14.7275 6.76995C14.4677 7.02968 14.3379 7.15954 14.2262 7.30273C14.0945 7.47163 13.9815 7.65439 13.8894 7.84776C13.8112 8.01169 13.7532 8.18591 13.637 8.53437L13.2651 9.65M21.0646 5.43797L17.23 9.27253C16.9703 9.53225 16.8405 9.66211 16.6973 9.7738C16.5284 9.90554 16.3456 10.0185 16.1522 10.1106C15.9883 10.1888 15.8141 10.2468 15.4656 10.363L14.35 10.7349M14.35 10.7349L13.6281 10.9755C13.4567 11.0327 13.2676 10.988 13.1398 10.8602C13.012 10.7324 12.9673 10.5433 13.0245 10.3719L13.2651 9.65M14.35 10.7349L13.2651 9.65"
                                            stroke="currentColor" stroke-width="1.5"/>
                                    </svg>
                                </label>
                            </div>
                            <div>
                                <div class="font-medium text-lg">{{auth()->user()->name}}</div>
                                <div class="text-gray-500">Joined {{auth()->user()->created_at->diffForHumans()}}</div>
                            </div>
                        </div>
                        <div class="flex justify-end items-end">
                            <div
                                class="bg-yellow-100 border border-yellow-300 text-yellow-700 p-4 rounded-lg max-w-sm mx-auto my-8 shadow-md">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h2 class="text-lg font-semibold">Welcome back!</h2>
                                        <p>Thank you for choosing Turning Hearts to keep the memory of your loved ones
                                            alive. We are honored to be a part of your healing journey.</p>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.5"/>
                                            <path d="M12 7V13" stroke="#1C274C" stroke-width="1.5"
                                                  stroke-linecap="round"/>
                                            <circle cx="12" cy="16" r="1" fill="#1C274C"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <ul class="flex flex-wrap justify-center w-full text-sm font-medium text-center border-b border-slate-200 dark:border-zink-500 nav-tabs">
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="favourites"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">My
                                    Favourites</a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="posts"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">Posts</a>
                            </li>
                            <li class="group active">
                                <a href="javascript:void(0);" data-tab-toggle data-target="medallions"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">Medallions</a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle data-target="account"
                                   class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 dark:group-[.active]:hover:text-custom-500 -mb-[1px]">My
                                    Accounts</a>
                            </li>
                        </ul>
                        <div class="mt-5 tab-content">
                            <div class="hidden tab-pane" id="favourites">
                                <livewire:user.profile.favourites/>
                            </div>
                            <div class="hidden tab-pane" id="posts">
                                <livewire:user.profile.posts/>
                            </div>
                            <div class="block tab-pane" id="medallions">
                                <livewire:user.profile.medallions/>
                            </div>
                            <div class="hidden tab-pane" id="account">
                                <livewire:user.profile.accounts/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modal name="update-profile-image" :show="$errors->isNotEmpty()" focusable max>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Change Profile Picture') }}
            </h2>
            <div >
                <livewire:utils.image-cropper field="image"/>
            </div>
    </x-modal>
</div>
