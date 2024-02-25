<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse($favourites as $favourite)
        <div class="bg-white rounded-lg shadow-lg p-4 max-w-sm border">
            <div class="flex justify-between items-center mb-4">
                <button class="text-yellow-400 hover:text-yellow-500"
                        wire:click="removeFavourite({{$favourite->id}})"
                        wire:confirm="{{ __('all.are_you_sure_remove_favourite') }}">
                    <i data-lucide="heart" class="w-5 h-5"
                       style="{{auth()->user()->hasFavourited($favourite->profile)?'fill: yellow;':''}}"></i>
                </button>
                <button class="text-gray-400 hover:text-gray-500">
                    <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="flex flex-col items-center">
                <img class="rounded-full mb-4"
                     src="{{$favourite->profile->profile_picture}}"
                     alt="Profile" style="width: 120px; height: 120px;">
                <h5 class="text-lg font-bold mb-2">{{$favourite->profile->full_name}}</h5>
                <p class="text-gray-500 mb-4">{{ __('all.lifetime', ['date_of_birth' => \Carbon\Carbon::parse($favourite->profile->date_of_birth)->format('d/m/Y'), 'date_of_death' => \Carbon\Carbon::parse($favourite->profile->date_of_death)->format('d/m/Y'), 'age' => $favourite->profile->age]) }}</p>
                <div class="flex justify-center gap-4">
                    <a type="button" href="{{route('profile.show',['id' => $favourite->profile->id])}}"
                       class="flex justify-center items-center gap-3 text-white px-5 btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                        {{ __('all.view') }}
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="flex items-center justify-center w-full h-96">
            <p class="text-gray-500">{{ __('all.no_favourites_found') }}</p>
        </div>
    @endforelse
</div>
