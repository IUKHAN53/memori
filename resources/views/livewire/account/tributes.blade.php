<div x-data="{ modelOpen: false }">
    <div class="rounded flex justify-end m-3">
        <button type="submit" @click="modelOpen =!modelOpen"
                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
            {{ __('all.post_tribute') }}
        </button>
    </div>
    <div class="shadow-lg rounded p-5 border mt-3">
        <div>
            @foreach($tributes as $tribute)
                <div class="flex flex-col justify-between items-center md:flex-row gap-3">
                    <div class="flex justify-start items-start flex-col md:flex-row gap-3">
                        <img class="h-16 w-16 rounded-full"
                             src="{{$tribute->user->picture}}"
                             alt="">
                        <div>
                            <h6 class="font-medium">{{$tribute->user->name}}</h6>
                            <p class="text-gray-500">{{$tribute->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                </div>
                <p class="mt-3">
                    {!! $tribute->tribute !!}
                </p>
                <div class="flex justify-start flex-col md:flex-row items-start md:items-center my-3 gap-3">
                    <div class="flex gap-3 items-center justify-center" wire:click="toggleLike({{$tribute->id}})">
                        <svg height="24px"
                             viewBox="0 0 512 512" width="24px" xml:space="preserve"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="_x31_66_x2C__Heart_x2C__Love_x2C__Like_x2C__Twitter">
                                                <g>
                                                    <path
                                                        d="M365.4,59.628c60.56,0,109.6,49.03,109.6,109.47c0,109.47-109.6,171.8-219.06,281.271    C146.47,340.898,37,278.568,37,169.099c0-60.44,49.04-109.47,109.47-109.47c54.73,0,82.1,27.37,109.47,82.1    C283.3,86.999,310.67,59.628,365.4,59.628z"
                                                        style="fill:#FF7979;"/>
                                                </g>
                                            </g>
                            <g id="Layer_1"/>
                                        </svg>
                        <span>{{ __('all.likes') }} ({{$tribute->likes}})</span>
                    </div>
                    <div class="flex gap-3 items-center justify-center">
                        <svg viewBox="0 0 48 48"
                             height="48px" width="48px"
                             xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Icons">
                                <g>
                                    <path
                                        d="M30.4177,14.5048h-17.53c-0.94,0-1.7001,0.76-1.7001,1.71v10.85c0,0.94,0.7601,1.7,1.7001,1.7    h3.7368l15.5031-11.5995v-0.9505C32.1276,15.2648,31.3576,14.5048,30.4177,14.5048z"
                                        style="fill:#0097D3;"/>
                                    <path
                                        d="M33.9921,31.3301l2.8203,2.1651v-3.98v-0.66v-10.19c0-0.95-0.77-1.71-1.71-1.71h-17.53    c-0.9389,0-1.7,0.7611-1.7,1.7v10.86c0,0.9388,0.7611,1.7,1.7,1.7h16.0812C33.776,31.2152,33.895,31.2555,33.9921,31.3301z"
                                        style="fill:#F4F4F4;"/>
                                    <g>
                                        <g>
                                            <path
                                                d="M31.0316,23.1193h-9.3779c-0.1934,0-0.3496-0.1562-0.3496-0.3496      c0-0.1933,0.1562-0.3496,0.3496-0.3496h9.3779c0.1934,0,0.3496,0.1563,0.3496,0.3496      C31.3812,22.9631,31.225,23.1193,31.0316,23.1193z"
                                                style="fill:#CCCCCC;"/>
                                        </g>
                                        <g>
                                            <path
                                                d="M29.3978,25.9611h-6.1103c-0.1934,0-0.3496-0.1562-0.3496-0.3496      c0-0.1933,0.1562-0.3496,0.3496-0.3496h6.1103c0.1934,0,0.3496,0.1563,0.3496,0.3496      C29.7474,25.8049,29.5912,25.9611,29.3978,25.9611z"
                                                style="fill:#CCCCCC;"/>
                                        </g>
                                    </g>
                                </g>
                            </g></svg>
                        <span>{{ __('all.comments') }}({{$tribute->comments()->count()}})</span>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <livewire:comments :model="$tribute"/>
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
                    <h1 class="text-xl font-medium text-gray-800 ">Post a new Tribute</h1>
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
                        <img class="h-16 w-16 rounded-full"
                             src="{{auth()->user()->picture}}"
                             alt="">
                        <div>
                            <h6 class="font-medium">{{auth()->user()->name}}</h6>
                        </div>
                    </div>
                    <div>
                        <label for="title">{{ __('all.title') }}</label>
                        <input type="text" class="form-input" wire:model="title" id="title">
                    </div>
                    <div>
                        <label for="description">{{ __('all.description') }}</label>
                        <textarea class="form-input" wire:model="tribute" id="description"
                                  rows="5"></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" wire:click="postTribute" @click="modelOpen =!modelOpen"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                            {{ __('all.publish') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
