<div x-data="{ modelOpen: false, videoTitle: @entangle('title') }">
    @if(session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($can_add)
        <div class="rounded flex justify-end medallion-profile-btn">
            <button type="button" @click="modelOpen = !modelOpen"
                    class="text-white btn bg-custom-500 border-custom-500">
                {{ __('all.add_new_video') }}
            </button>
        </div>
    @endif

    <!-- Videos Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        @foreach($videos as $video)
            <div class="rounded-20 flex flex-col">
                <iframe width="100%" height="240px" class="mini_video"
                        src="{{ $video->embed_url }}" frameborder="0"
                        allowfullscreen="true" scrolling="no" onscroll="return false;"></iframe>
                <div class="photo-text-container">
                    <h5 style="margin-bottom: 1rem;">{{ $video->title }}</h5>
                    <p style="margin-bottom: 1rem;">{{ $video->description }}</p>
                    @if($this->canDeleteVideo($video))
                        <button class="text-red-400 hover:text-red-500 float-right"
                                wire:click="removeVideo({{ $video->id }})"
                                wire:confirm="{{ __('all.are_you_sure_remove_video') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                                 viewBox="0,0,256,256">
                                <g fill="#ff0000" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                   stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                   font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                   style="mix-blend-mode: normal">
                                    <g transform="scale(5.33333,5.33333)">
                                        <path
                                            d="M20.5,4c-0.49034,-0.00628 -0.95279,0.22749 -1.23848,0.62606c-0.28569,0.39856 -0.35854,0.9116 -0.19511,1.37394h-4.42578c-1.83725,0 -3.5577,0.91945 -4.57617,2.44922l-2.36719,3.55078h-0.19727c-0.54095,-0.00765 -1.04412,0.27656 -1.31683,0.74381c-0.27271,0.46725 -0.27271,1.04514 0,1.51238c0.27271,0.46725 0.77588,0.75146 1.31683,0.74381h0.76367c0.12867,0.01945 0.25932,0.02208 0.38867,0.00781l2.47266,23.07813c0.29835,2.78234 2.67084,4.91406 5.46875,4.91406h14.81055c2.79791,0 5.1704,-2.13172 5.46875,-4.91406l2.47461,-23.07813c0.12677,0.01359 0.25475,0.01097 0.38086,-0.00781h0.77148c0.54095,0.00765 1.04412,-0.27656 1.31683,-0.74381c0.27271,-0.46725 0.27271,-1.04514 0,-1.51238c-0.27271,-0.46725 -0.77588,-0.75146 -1.31683,-0.74381h-0.19727l-2.36719,-3.55078c-1.01929,-1.52894 -2.73955,-2.44922 -4.57617,-2.44922h-4.42578c0.16343,-0.46234 0.09058,-0.97538 -0.19511,-1.37394c-0.28569,-0.39856 -0.74814,-0.63234 -1.23848,-0.62606zM14.64063,9h18.71875c0.83737,0 1.61537,0.41622 2.08008,1.11328l1.25781,1.88672h-25.39453l1.25781,-1.88672c0.00065,-0.00065 0.0013,-0.0013 0.00195,-0.00195c0.46348,-0.69619 1.23938,-1.11133 2.07813,-1.11133zM11.66992,15h24.66016l-2.43945,22.76563c-0.13765,1.28366 -1.19624,2.23438 -2.48633,2.23438h-14.81055c-1.29009,0 -2.34673,-0.95071 -2.48437,-2.23437z"></path>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Video Modal -->
    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
         aria-modal="true"
         x-init="
    window.addEventListener('closeModal', event => {
        modelOpen = false;
        lucide.createIcons();
    })
">
        >
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity bg-opacity-40" aria-hidden="true"
                 style="background-color: #6b7280b3">
            </div>

            <!-- Modal Content -->
            <div x-cloak x-show="modelOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="popup-add-content inline-block w-60 shadow-2xl max-w-xl p-8 my-8 overflow-hidden text-left transition-all transform bg-white rounded-lg sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800">{{ __('all.add_new_video') }}</h1>
                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
                <p class="mt-2 text-sm text-gray-500" style="text-align: right;">
                    {{ __('all.add_video_url_details') }}
                </p>
                <form class="mt-5" wire:submit="addVideo">
                    <div>
                        <label class="block text-sm text-gray-700 capitalize dark:text-gray-200"
                               style="text-align: right;">
                            {{ __('all.youtube_video_url') }}
                        </label>
                        <input placeholder="{{ __('all.enter_video_url') }}" type="text" wire:model="url"
                               class="block w-full px-3 py-2 mt-2 mb-3 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @error('url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                        <label class="block text-sm text-gray-700 capitalize dark:text-gray-200"
                               style="text-align: right;">
                            {{ __('all.video_title') }}
                        </label>
                        <input placeholder="{{ __('all.enter_video_title') }}" type="text" wire:model="title"
                               class="block w-full px-3 py-2 mt-2 mb-3 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                        <label class="block text-sm text-gray-700 capitalize dark:text-gray-200"
                               style="text-align: right;">
                            {{ __('all.description') }}
                        </label>
                        <input placeholder="{{ __('all.enter_video_description') }}" type="text"
                               wire:model="description"
                               class="block w-full px-3 py-2 mt-2 mb-3 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-start mt-6">
                        <button type="submit"
                                class="rounded-full px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-custom-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            {{ __('all.add') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
