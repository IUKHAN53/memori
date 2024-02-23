<div x-data="{ modelOpen: false }">
    @if($can_add)
        <div class="rounded flex justify-end">
            <button type="submit" @click="modelOpen =!modelOpen"
                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                Add New Photo
            </button>
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        @foreach($photos as $picture)
            <div class="rounded shadow flex flex-col gap-3">
                <img class="rounded cursor-pointer" style="max-width: 100%"
                     data-modal-target="{{$loop->index}}_imageDetailModal"
                     src="{{ $picture->image }}"
                     alt="">
                <h6 style="font-size:16px;padding:10px">{{ $picture->caption }}</h6>
                <div id="{{$loop->index}}_imageDetailModal" modal-top=""
                     class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 show">
                    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col">
                        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex justify-center items-center">
                                    <img class="rounded" style="max-width: 100%"
                                         src="{{ $picture->image }}"
                                         alt="">
                                </div>
                                <div class="flex flex-col justify-between gap-5">
                                    <style>
                                        .bg-primary-700 {
                                            background-color: #4b5563;
                                        }
                                    </style>
                                    <livewire:comments :model="$picture"/>
                                </div>
                            </div>
                        </div>
                    </div>
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
                 class="inline-block w-50 shadow-2xl max-w-xl p-8 my-8 overflow-hidden text-left transition-all transform bg-white rounded-lg sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">Add a new Photo</h1>
                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
                <p class="mt-2 text-sm text-gray-500 ">
                    Add photo and enter details
                </p>
                <form class="mt-5">
                    <div>
                        <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                            Photo
                        </label>
                        <input placeholder="Photo" type="file" wire:model="photo"
                               class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <label for="user name" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                            Caption
                        </label>
                        <input placeholder="Caption" type="text" wire:model="caption"
                               class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                        @error('caption') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="button" wire:click="addPhoto" @click="modelOpen = false"
                                class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-custom-500 rounded-md dark:bg-custom-600 dark:hover:bg-custom-700 dark:focus:bg-custom-700 hover:bg-custom-600 focus:outline-none focus:bg-custom-500 focus:ring focus:ring-custom-300 focus:ring-opacity-50">
                            + Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

