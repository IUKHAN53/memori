<div x-data="{ modelOpen: false, videoTitle: @entangle('title') }">
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
                    <button class="text-red-400 hover:text-red-500 float-right"
                            wire:click="removeVideo({{ $video->id }})"
                            wire:confirm="{{ __('all.are_you_sure_remove_video') }}">
                        <span wire:ignore><i data-lucide="trash" class="w-5 h-5"></i></span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Video Modal -->
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
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('refreshVideos', () => {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            });
            Livewire.on('closeModal', () => {
                document.querySelector('[x-data="{ modelOpen: false }"]').__x.$data.modelOpen = false;
            });
        });
    </script>
</div>
