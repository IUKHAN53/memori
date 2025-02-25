<div class="grid grid-cols-1 gap-4">
    @forelse($posts as $post)
        <div class="bg-white rounded-20 shadow-lg p-4 max-w-sm border" wire:key="post-{{ $post->id }}">
            <div class="flex justify-end">
                <button wire.ignore class="text-red-400 float-end hover:text-yellow-500"
                        wire:click="deletePost({{$post->id}})"
                        wire:confirm="{{ __('all.delete_post') }}">
                    <span wire:ignore><i data-lucide="trash" class="w-8 h-8"></i></span>
                </button>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row" style="align-items: center;">
                    <img class="rounded-full mb-4"
                         src="{{$post->profile->profile_picture}}"
                         alt="Profile" style="width: 40px; height: 40px; margin-left: 1rem;">
                    <div>
                        <h5 style="font-size: 16px;" class="font-bold mb-2">{{$post->profile->full_name}}</h5>
                    </div>
                </div>
                <p class="text-slate-600"><strong>מאת: </strong>{{auth()->user()->name}}</p>
                <p style="font-size: 12px;" class="text-gray-400 mb-3">{{$post->created_at->diffForHumans()}}</p>
                <p class="text-slate-600 mb-3"><strong>{{ __('all.post_title') }}: </strong>{{$post->title}}</p>
                <p class="text-slate-600 mb-3"><strong>{{ __('all.post_content') }}: </strong>{{$post->tribute}}</p>
                <div class="flex justify-center gap-4">
                    <a type="button" href="{{route('profile.show',['id' => $post->profile->id])}}"
                       class="flex justify-center items-center gap-3 text-white px-5 btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                        <span wire:ignore><i data-lucide="eye" class="w-5 h-5"></i></span>
                        {{ __('all.view_profile') }}
                    </a>
                    <button wire:click="startEditing({{ $post->id }})"
                            class="flex justify-center items-center gap-3 text-white px-5 btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-blue-100 active:text-white active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                        <span wire:ignore><i data-lucide="edit" class="w-5 h-5"></i></span>
                        {{ __('all.edit_post') }}
                    </button>
                </div>
            </div>
        </div>
        @if($editingPostId === $post->id)
            <div class="mt-4 p-4 border rounded">
                <input type="text" wire:model="editTitle" placeholder="{{ __('all.post_title') }}"
                       class="w-full p-2 border rounded mb-2">
                <textarea wire:model="editTribute" placeholder="{{ __('all.post_content') }}"
                          class="w-full p-2 border rounded mb-2"></textarea>
                <div class="flex gap-2">
                    <button wire:click="updatePost({{ $post->id }})"
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        {{ __('all.save_changes') }}
                    </button>
                    <button wire:click="cancelEditing"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        {{ __('all.cancel') }}
                    </button>
                </div>
            </div>
        @endif
    @empty
        <div class="flex items-center justify-center w-full h-96">
            <p class="text-gray-500">{{ __('all.no_posts_found') }}</p>
        </div>
    @endforelse

    <script>
        document.addEventListener("livewire:update", () => {
            // Reinitialize lucide icons after Livewire re-renders the DOM.
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</div>
