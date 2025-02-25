<div class="grid grid-cols-1 gap-4">
    @forelse($posts as $post)
        <div class="bg-white rounded-20 shadow-lg p-4 max-w-sm border">
            <div class="flex justify-end">
                <button class="text-red-400 float-end hover:text-yellow-500" wire:click="deletePost({{$post->id}})"
                        wire:confirm="{{ __('all.delete_post') }}">
                    <i data-lucide="trash" class="w-8 h-8"></i>
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
                        <i data-lucide="eye" class="w-5 h-5"></i>
                        {{ __('all.view_profile') }}
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="flex items-center justify-center w-full h-96">
            <p class="text-gray-500">{{ __('all.no_posts_found') }}</p>
        </div>
    @endforelse
</div>
