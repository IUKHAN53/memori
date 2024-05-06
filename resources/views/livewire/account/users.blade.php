<div x-data="{ modelOpen: false }">
    <div class="rounded flex justify-end m-3">
        <button type="submit" @click="modelOpen =!modelOpen"
                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
            {{ __('all.invite_user') }}
        </button>
    </div>
    <div class="shadow-lg rounded p-5 border mt-3">
        <x-action-message class="me-3" on="user-removed">
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                 role="alert">
                <span class="font-medium">{{__('all.operation_successful')}}</span>
            </div>
        </x-action-message>
        <div x-data="{ selectedTab: 'users' }" class="w-full">
            <div @keydown.right.prevent="$focus.wrap().next()" @keydown.left.prevent="$focus.wrap().previous()"
                 class="flex gap-2 overflow-x-auto border-b border-slate-300 dark:border-slate-700" role="tablist"
                 aria-label="tab options">
                <button @click="selectedTab = 'users'" :aria-selected="selectedTab === 'users'"
                        :tabindex="selectedTab === 'users' ? '0' : '-1'"
                        :class="selectedTab === 'users' ? 'font-bold text-blue-700 border-b-2 border-blue-700 dark:border-blue-600 dark:text-blue-600' : 'text-slate-700 font-medium dark:text-slate-300 dark:hover:border-b-slate-300 dark:hover:text-white hover:border-b-2 hover:border-b-slate-800 hover:text-black'"
                        class="h-min px-4 py-2 text-sm" type="button" role="tab"
                        aria-controls="tabpanelGroups">{{__('all.users')}}
                </button>
                <button @click="selectedTab = 'invitations'" :aria-selected="selectedTab === 'invitations'"
                        :tabindex="selectedTab === 'invitations' ? '0' : '-1'"
                        :class="selectedTab === 'invitations' ? 'font-bold text-blue-700 border-b-2 border-blue-700 dark:border-blue-600 dark:text-blue-600' : 'text-slate-700 font-medium dark:text-slate-300 dark:hover:border-b-slate-300 dark:hover:text-white hover:border-b-2 hover:border-b-slate-800 hover:text-black'"
                        class="h-min px-4 py-2 text-sm" type="button" role="tab"
                        aria-controls="tabpanelLikes">{{__('all.invitations')}}
                </button>
            </div>
            <div class="px-2 py-4 text-slate-700 dark:text-slate-300">
                <div x-show="selectedTab === 'users'" id="tabpanelGroups" role="tabpanel" aria-label="users">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('all.name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('all.email') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('all.role') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="{{ $user->user->picture }}"
                                                     alt="{{ $user->user->name }}">
                                            </div>
                                            <div class="text-sm font-medium text-gray-900 m-4">
                                                {{ $user->user->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if(auth()->id() == $user->user_id)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Owner
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ __('all.user') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if(!$user->is_owner)
                                            <button type="button" class="text-red-600"
                                                    wire:click="removeUser({{$user->id}})"
                                                    wire:confirm="{{__('all.are_you_sure_remove_user')}}">
                                                <i data-lucide="trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div x-show="selectedTab === 'invitations'" id="tabpanelLikes" role="tabpanel" aria-label="invitations">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('all.email') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('all.status') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($invitations as $invitation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $invitation->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($invitation->is_accepted)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ __('all.accepted') }}
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                {{ __('all.pending') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button type="button" class="text-red-600"
                                                wire:click="removeInvitation({{$invitation->id}})"
                                                wire:confirm="{{__('all.are_you_sure_remove_invitation')}}">
                                            <i data-lucide="trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                 class="fixed inset-0 transition-opacity" aria-hidden="true"
                 style="background-color: #6B7280; opacity: 0.6;">
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
                    <h1 class="text-xl font-medium text-gray-800 ">{{__('all.invite_user')}}</h1>
                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
                <div class="space-y-5">
                    <div>
                        <x-input-label for="email" :value="__('all.email')"/>
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                                      required autofocus/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>
                    <div class="flex items-center justify-between">
                        <div wire:loading wire:loading.target="inviteUser">
                            <x-loading/>
                        </div>
                        <button wire:loading.remove type="submit" wire:click="inviteUser"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                            {{ __('all.send_invitation') }}
                        </button>
                    </div>
                    <x-action-message class="me-3" on="user-invited">
                        <div
                            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <span class="font-medium">{{ __('all.invitation_sent_message') }}</span>
                        </div>
                    </x-action-message>
                </div>
            </div>
        </div>
    </div>
</div>
