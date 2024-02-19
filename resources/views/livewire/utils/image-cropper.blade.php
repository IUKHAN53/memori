<div>
    <div wire:ignore class="tf-cropper-root">
        <div x-data="imageCropper({
        imageUrl: '{{ data_get($this, $field['id']) }}',
        width: {{ $field['width'] }},
        height: {{ $field['height'] }},
        shape: '{{ $field['shape'] }}',
        fieldKey: '{{ $field['id'] }}'
    })" x-cloak>
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
                        Drag and drop or select a file
                    </label>
                    <p class="tf-cropper-file-info">
                        Jpg, gif, png, Max Size 4MB
                    </p>
                    <button type="button" x-on:click.prevent class="tf-cropper-upload">
                        Upload
                    </button>
                </div>

            </div>

            {{-- cropper --}}
            <div x-show="showCroppie" x-on:click.prevent class="tf-cropper-modal-bg">
                <div class="tf-cropper-modal">
                    <div>
                        <div class="m-auto" x-ref="croppie"></div>
                        <div class="flex justify-center items-center gap-2">
                            <button type="button" class="text-red-600"
                                    x-on:click.prevent="swap()"><i data-lucide="trash"></i></button>
                            <button type="button" class="text-custom-600"
                                    x-on:click.prevent="saveCroppie()"><i data-lucide="save"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- result--}}
            <div x-show="!showCroppie && hasImage" class="relative {{ $field['thumbnail'] }}">
                <div class="tf-cropper-btns-root">
                    <div class="tf-cropper-btns-wrapper">
                        <button type="button" class="tf-cropper-swap" x-on:click.prevent="remove()">
                            <i data-lucid="x"></i>
                        </button>
                        <button type="button" class="tf-cropper-edit" x-on:click.prevent="edit()">
                            <i data-lucid="x"></i>
                        </button>
                    </div>
                </div>
                <div><img src="{{ data_get($this, $field['key']) }}" alt x-ref="result" class="display-block"></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageCropper', (config) => ({
                showCroppie: false,
                hasImage: config.imageUrl.length > 0,
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
                swap() {
                    this.$refs.input.value = null
                    this.showCroppie = false
                    this.hasImage = false
                    this.$refs.result.src = ""
                },
                remove() {
                    this.$refs.input.value = null
                    this.showCroppie = false
                    this.hasImage = false
                    this.$refs.result.src = ""
                    this.$wire.set(this.fieldKey, '')
                },
                edit() {
                    this.$refs.input.value = null
                    this.showCroppie = true
                    this.hasImage = false
                    this.$refs.result.src = ""
                    this.bindCroppie(this.originalSrc)
                },
                saveCroppie() {
                    this.croppie.result({
                        type: "base64",
                        size: "original"
                    }).then((croppedImage) => {
                        this.$refs.result.src = croppedImage
                        this.showCroppie = false
                        this.hasImage = true
                        this.$wire.set(this.fieldKey, croppedImage)
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
