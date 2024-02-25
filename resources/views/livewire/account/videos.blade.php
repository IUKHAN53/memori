<div x-data="{ modelOpen: false }">
    @if($can_add)
        <div class="rounded flex justify-end">
            <button type="submit" @click="modelOpen =!modelOpen"
                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                {{ __('all.add_new_video') }}
            </button>
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        @foreach($videos as $video)
            <div class="rounded shadow flex flex-col gap-3">
                <iframe style="" width="100%" height="240px" class="mini_video"
                        src="{{$video->embed_url}}" frameborder="0"
                        allowfullscreen="true" scrolling="no" onscroll="return false;"></iframe>
                <div class="p-3">
                    <h6 style="font-size:16px">{{$video->title}}</h6>
                    <p>{{$video->description}}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true">
            </div>

            <!-- Modal -->
            <div x-cloak x-show="modelOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block w-60 shadow-2xl max-w-xl p-8 my-8 overflow-hidden text-left transition-all transform bg-white rounded-lg sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                 style="width: 30%;"
            >
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">{{ __('all.add_new_video') }}</h1>
                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
                <p class="mt-2 text-sm text-gray-500 ">
                    {{ __('all.add_video_url_details') }}
                </p>
                <form class="mt-5">
                    <div>
                        <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                            {{ __('all.youtube_video_url') }}
                        </label>
                        <input placeholder="{{ __('all.enter_video_url') }}" type="text" wire:model="url"
                               class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @error('url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                            {{ __('all.video_title') }}
                        </label>
                        <input placeholder="{{ __('all.enter_video_title') }}" type="text" wire:model="title"
                               class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                            {{ __('all.description') }}
                        </label>
                        <input placeholder="{{ __('all.enter_video_description') }}" type="text" wire:model="description"
                               class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="button" wire:click="addVideo" @click="modelOpen = false"
                                class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-custom-500 rounded-md dark:bg-custom-600 dark:hover:bg-custom-700 dark:focus:bg-custom-700 hover:bg-custom-600 focus:outline-none focus:bg-custom-500 focus:ring focus:ring-custom-300 focus:ring-opacity-50">
                            {{ __('all.add') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

