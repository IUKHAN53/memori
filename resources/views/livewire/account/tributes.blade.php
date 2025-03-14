<div x-data="{ modelOpen: false }">
    <div class="rounded flex justify-end m-3 medallion-profile-btn">
        <button type="submit" @click="modelOpen =!modelOpen"
                class="text-white btn bg-custom-500 border-custom-500">
            {{ __('all.post_tribute') }}
        </button>
    </div>
    <div>
        <div>
            @foreach($tributes as $tribute)
            <div class="rounded-20 p-5 border mb-4">
                <div class="flex flex-col justify-between items-right md:flex-row gap-3 mb-4">
                    <div class="flex justify-start items-center flex-row gap-3">
                        <img class="h-12 w-12 rounded-full"
                             src="{{$tribute->user->picture}}"
                             alt="">
                        <div>
                            <h6 style="font-size: 16px;">{{$tribute->user->name}}</h6>
                            <p class="text-gray-500">{{$tribute->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                </div>
                <h5>{!! $tribute->title !!}</h5>
                <p class="mt-3">
                    {!! nl2br(e($tribute->tribute)) !!}
                </p>
            </div>
            @endforeach
        </div>
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
                 class="fixed inset-0 transition-opacity bg-opacity-40" aria-hidden="true"  style="background-color: #6b7280b3">
            </div>

            <!-- Modal -->
            <div x-cloak x-show="modelOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="popup-add-content inline-block w-60 shadow-2xl max-w-xl p-8 my-8 overflow-hidden text-left transition-all transform bg-white rounded-lg sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                 style="width: 30%;"
            >
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">כתבו סיפור חדש</h1>
                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
                <div class="space-y-5">
                    <div class="flex justify-start items-center gap-3">
                        @auth()
                            <img class="h-16 w-16 rounded-full"
                             src="{{auth()->user()->picture}}"
                             alt="">
                        <div>
                            <h6 class="font-medium">{{auth()->user()->name}}</h6>
                        </div>

                        @endauth
                    </div>
                    <div style="text-align: right;">
                        <label for="title">{{ __('all.title') }}</label>
                        <input type="text" class="form-input" wire:model="title" id="title">
                    </div>
                    <div style="text-align: right;">
                        <label for="description">{{ __('all.description') }}</label>
                        <textarea class="form-input" wire:model="tribute" id="description"
                                  rows="5"></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" wire:click="postTribute" @click="modelOpen =!modelOpen"
                                class="rounded-full px-3 py-2 mt-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-custom-500">
                                {{ __('all.add') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
