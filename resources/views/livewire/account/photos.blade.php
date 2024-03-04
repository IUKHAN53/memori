<div x-data="{ modelOpen: false }">
    <div wire:loading class="flex justify-center align-middle">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Loading...</span>
    </div>
    @if($can_add)
        <div class="rounded flex justify-end">
            <button type="submit" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add-photo-modal')"
                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                {{ __('all.add_new_photo') }}
            </button>
        </div>
    @endif
    <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-4 gap-5">
        @foreach($photos as $picture)
            <div class="rounded shadow flex flex-col gap-3">
                <img class="rounded cursor-pointer" style="max-width: 100%"
                     data-modal-target="{{$loop->index}}_imageDetailModal"
                     src="{{ $picture->image }}"
                     alt="">
                <div>
                    <h6 style="font-size:16px;padding:10px">{{ $picture->caption }}</h6>
                    <button class="text-red-400 hover:text-red-500 float-right p-2"
                            wire:click="removePhoto({{$picture->id}})"
                            wire:confirm="{{ __('all.are_you_sure_remove_photo') }}">
                        <i data-lucide="trash" class="w-5 h-5"></i>
                    </button>
                </div>
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

    <x-modal name="add-photo-modal" :show="$errors->isNotEmpty()" focusable max>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('all.add_photo_enter_details') }}
        </h2>
        <div x-data="imageCropper({
        width: {{ $field['width'] }},
        height: {{ $field['height'] }},
        shape: '{{ $field['shape'] }}',
        fieldKey: '{{ $field['id'] }}'
    })" x-cloak>
            <div>
                <div wire:ignore class="tf-cropper-root">
                    <div>
                        <div x-show="!showCroppie && !hasImage">
                            <input type="file"
                                   name="{{ $field['name'] }}"
                                   id="{{ $field['id'] }}"
                                   class="absolute inset-0 z-5 m-0 p-0 w-full h-full outline-none opacity-0 cursor-pointer"
                                   @if($field['disabled']) disabled @endif
                                   x-ref="input"
                                   x-on:change="updatePreview()"
                                   x-on:dragover="$el.classList.add('active')"
                                   x-on:dragleave="$el.classList.remove('active')"
                                   x-on:drop="$el.classList.remove('active')">

                            {{-- upload icon --}}
                            <div class="flex flex-col items-center justify-center">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="none"
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
                                <label for="{{ $field['id'] }}" class="tf-cropper-drop-zone">
                                    {{ __('all.drag_and_drop_or_select_a_file') }}
                                </label>
                                <p class="tf-cropper-file-info">
                                    {{ __('all.jpg_gif_png_max_size') }}
                                </p>
                                <button type="button" x-on:click.prevent class="tf-cropper-upload">
                                    {{ __('all.upload') }}
                                </button>
                            </div>
                        </div>
                        <div x-show="showCroppie" x-on:click.prevent class="tf-cropper-modal-bg">
                            <div class="tf-cropper-modal">
                                <div>
                                    <div class="m-auto" x-ref="croppie"></div>
                                    <div class="flex justify-center items-center gap-2">
                                        <button type="button" class="text-red-600"
                                                x-on:click.prevent="remove()"><i data-lucide="trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('photo') <span class="text-red-500 text-xs">{{$message}}</span> @enderror
                </div>
                <div>
                    <label for="caption" class="block text-sm text-gray-700 capitalize dark:text-gray-200">
                        {{ __('all.caption') }}
                    </label>
                    <input placeholder="{{ __('all.caption') }}" type="text" wire:model="caption"
                           class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                    @error('caption') <span class="text-red-500 text-xs">{{$message}}</span> @enderror
                </div>
                <div>
                    <button type="button" x-on:click.prevent="saveCroppie()"
                            class="px-3 py-2 mt-6 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-custom-500 rounded-md dark:bg-custom-600 dark:hover:bg-custom-700 dark:focus:bg-custom-700 hover:bg-custom-600 focus:outline-none focus:bg-custom-500 focus:ring focus:ring-custom-300 focus:ring-opacity-50">
                        {{ __('all.add') }}
                    </button>
                </div>
            </div>
        </div>
    </x-modal>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageCropper', (config) => ({
                showCroppie: false,
                hasImage: false,
                originalSrc: config.imageUrl,
                width: config.width,
                height: config.height,
                shape: config.shape,
                fieldKey: config.fieldKey,
                croppie: {},
                init() {
                    this.$nextTick(() => this.initCroppie())
                },
                updatePreview() {
                    let reader, files = this.$refs.input.files
                    reader = new FileReader()
                    reader.onload = (e) => {
                        this.showCroppie = true
                        this.originalSrc = e.target.result
                        this.bindCroppie(e.target.result)
                    }
                    reader.readAsDataURL(files[0])
                },
                initCroppie() {
                    this.croppie = new Croppie(this.$refs.croppie, {
                        viewport: {width: this.width, height: this.height, type: this.shape}, //circle or square
                        boundary: {width: this.width, height: this.height}, //default boundary container
                        showZoomer: true,
                        enableResize: false
                    })
                },
                remove() {
                    this.$refs.input.value = null
                    this.showCroppie = false
                    this.hasImage = false
                    this.$refs.result.src = ""
                    this.$wire.set(this.fieldKey, '')
                },
                saveCroppie() {
                    this.croppie.result({
                        type: "base64",
                        size: "original"
                    }).then((croppedImage) => {
                        this.$wire.photo = croppedImage
                        Livewire.dispatch('savePhoto', {'image':croppedImage});
                        this.$dispatch('close-modal', 'add-photo-modal');
                    })
                },
                bindCroppie(src) { //avoid problems with croppie container not being visible when binding
                    setTimeout(() => {
                        this.croppie.bind({url: src})
                    }, 200)
                }
            }))
        })
    </script>
</div>

