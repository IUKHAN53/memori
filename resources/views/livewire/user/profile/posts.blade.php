<div class="grid grid-cols-1 gap-4">
    @forelse($posts as $post)
        <div class="bg-white rounded-lg shadow-lg p-4 max-w-sm border">
            <div class="flex justify-end mb-4">
                <button class="text-red-400 float-end hover:text-yellow-500" wire:click="deletePost({{$post->id}})"
                        wire:confirm="{{ __('all.delete_post') }}">
                    <i data-lucide="trash" class="w-8 h-8"></i>
                </button>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row">
                    <img class="rounded-full mb-4"
                         src="{{$post->profile->profile_photo_url}}"
                         alt="Profile" style="width: 120px; height: 120px;">
                    <div>
                        <h5 class="text-lg font-bold mb-2">{{$post->profile->full_name}}</h5>
                        <p class="text-gray-500 mb-4">{{ __('all.lifetime') }}: {{\Carbon\Carbon::parse($post->profile->date_of_birth)->format('d/m/Y')}}
                            - {{\Carbon\Carbon::parse($post->profile->date_of_death)->format('d/m/Y')}}
                            ({{$post->profile->age}} {{ __('all.years') }})</p>
                    </div>
                </div>
                <p class="text-gray-500 mb-4"><strong>{{ __('all.post_created_at') }}: </strong>{{$post->created_at->diffForHumans()}}</p>
                <p class="text-gray-500 mb-4"><strong>{{ __('all.post_title') }}: </strong>{{$post->title}}</p>
                <p class="text-gray-500 mb-4"><strong>{{ __('all.post_content') }}: </strong>{{$post->tribute}}</p>
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
