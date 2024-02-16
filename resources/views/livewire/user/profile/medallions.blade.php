<div>
    <div class="{{!$list_screen ? 'hidden' : ''}}">
        <div class="mb-3">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Profiles</h2>
                <button wire:click="showAddScreen()"
                        class="bg-custom-500 hover:bg-custom-800 font-bold py-2 px-4 rounded inline-flex items-center text-white gap-2">
                    <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                         viewBox="0 0 45.402 45.402" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier"
                                                                                              stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141 c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27 c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435 c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path>
                            </g>
                        </g></svg>
                    <span> Create New Profile</span>
                </button>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Full Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Relationship
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Picture
                    </th>
                    <th scope="col" class="px-6 py-3">
                        QR Code
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($profiles as $profile)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$profile->full_name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$profile->relationship}}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{$profile->profile_picture}}" alt="{{$profile->full_name}}"
                                 class="w-10 h-10 rounded-full">
                        </td>
                        <td class="px-6 py-4">
                            @if($profile->qr_code)
                                <img src="{{$profile->qr_code->image}}" alt="{{$profile->full_name}}"
                                     class="w-10 h-10 rounded-full">
                            @else
                                <a href="#" target="_blank">Buy QR Codes</a>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex">
                                <a href="#" wire:click="showAddScreen({{$profile->id}})"
                                   class="font-medium text-custom-600 dark:text-white-500 hover:underline">
                                    <svg width="28px" height="28px" viewBox="0 0 24.00 24.00" fill="none"
                                         xmlns="http://www.w3.org/2000/svg" transform="rotate(0)">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z"
                                                  fill="#3b82f6"></path>
                                        </g>
                                    </svg>
                                </a>
                                <a href="#" wire:click="deleteProfile({{$profile->id}})" wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">
                                    <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg" stroke="#fe4848">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M10 12V17" stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                            <path d="M14 12V17" stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                            <path d="M4 7H20" stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                            <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"
                                                  stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                            <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                  stroke="#fe3939" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="{{!$add_screen ? 'hidden' : ''}}">
        <a href="#" wire:click="showListScreen" class="flex mb-5 gap-2">
            <svg fill="#000000" height="25px" width="25px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g
                    id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path id="XMLID_92_"
                          d="M111.213,165.004L250.607,25.607c5.858-5.858,5.858-15.355,0-21.213c-5.858-5.858-15.355-5.858-21.213,0.001 l-150,150.004C76.58,157.211,75,161.026,75,165.004c0,3.979,1.581,7.794,4.394,10.607l150,149.996 C232.322,328.536,236.161,330,240,330s7.678-1.464,10.607-4.394c5.858-5.858,5.858-15.355,0-21.213L111.213,165.004z"></path>
                </g></svg>
            <h4>Create New Profile</h4>
        </a>
        <h5 style="font-weight: normal">Personal Details</h5>
        <hr>
        <p class="my-3">
            Start by entering as much info as you can about your loved one. You will have a
            chance to update this later.
        </p>
        <form wire:submit.prevent="saveProfile">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Whoops! Something went wrong.</strong>
                    <span class="block sm:inline">Please check the form for errors.</span>
                    <ul class="mt-3 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-3">
                <div>
                    <label for="first_name" class="inline-block mb-2 text-base font-medium">
                        First name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="first_name" wire:model="form.first_name"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="middle_name" class="inline-block mb-2 text-base font-medium">Middle
                        name <span class="text-red-500">*</span></label>
                    <input type="text" id="middle_name" wire:model="form.middle_name"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="last_name" class="inline-block mb-2 text-base font-medium">Last
                        name <span class="text-red-500">*</span></label>
                    <input type="text" id="last_name" wire:model="form.last_name"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
                <div>
                    <label for="title"
                           class="inline-block mb-2 text-base font-medium">Title</label>
                    <input type="text" id="title" wire:model="form.title"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="relationship">Relationship</label>
                    <select
                        id="relationship"
                        wire:model="form.relationship"
                        class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                        <option selected="">Open this select menu</option>
                        <option value="Aunt">Aunt</option>
                        <option value="Boyfriend">Boyfriend</option>
                        <option value="Brother">Brother</option>
                        <option value="Cousin">Cousin</option>
                        <option value="Daughter">Daughter</option>
                        <option value="Father">Father</option>
                        <option value="Girlfriend">Girlfriend</option>
                        <option value="Granddaughter">Granddaughter</option>
                        <option value="Grandfather">Grandfather</option>
                        <option value="Grandmother">Grandmother</option>
                        <option value="Grandson">Grandson</option>
                        <option value="Great grandfather">Great grandfather</option>
                        <option value="Great grandmother">Great grandmother</option>
                        <option value="Husband">Husband</option>
                        <option value="Mother">Mother</option>
                        <option value="Nephew">Nephew</option>
                        <option value="Niece">Niece</option>
                        <option value="Sister">Sister</option>
                        <option value="Son">Son</option>
                        <option value="Uncle">Uncle</option>
                        <option value="Wife">Wife</option>
                    </select>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
                <div>
                    <label for="profile_picture">Profile picture</label>
                    <input type="file" id="profile_picture" wire:model="picture"
                           class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                           placeholder="Enter your name">
                </div>
                <div>
                    @if ($picture && $picture->temporaryUrl())
                        <img class="rounded-full w-20 h-20 border-2 border-custom-400" src="{{ $picture->temporaryUrl() }}">
                    @elseif($profile_picture !== null)
                        <img class="rounded-full w-20 h-20 border-2 border-custom-400" src="{{ $profile_picture }}">
                    @endif
                </div>
            </div>
            <h5 style="font-weight: normal">Headline text</h5>
            <hr>
            <div class="my-3">
                <label for="text_or_phrase">Text or phrase</label>
                <input type="text" id="text_or_phrase" wire:model="form.heading_text"
                       class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                >
            </div>
            <p>
                This headline text is the one that shows above the name of the person. If this
                field is null, the headline text won’t be added.
            </p>
            <div class="flex items-center gap-2 my-3">
                <input id="is_include_heading" wire:model="form.include_heading_text"
                       class="border h-4 w-4 rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                       type="checkbox" value="1" checked="">
                <label for="is_include_heading" class="align-middle">
                    Don’t include headline text
                </label>
            </div>
            <h5 style="font-weight: normal">Obituary Information</h5>
            <hr>
            <div class="my-3">
                <label for="link_to_obituary">Link to Obituary:</label>
                <input type="text" id="link_to_obituary" wire:model="form.obituary_link"
                       class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                >
            </div>
            <div class="my-3">
                <label for="bio_info" class="inline-block mb-2 text-base font-medium">
                    Bio information:
                </label>
                <textarea
                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    id="bio_info" wire:model="form.bio" rows="3"></textarea>
            </div>
            <h5 style="font-weight: normal">Lifetime</h5>
            <hr>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
                <div>
                    <label for="dob"
                           class="inline-block mb-2 text-base font-medium">
                        Birth date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="dob" wire:model="form.date_of_birth"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="dod"
                           class="inline-block mb-2 text-base font-medium">
                        Death date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="dod" wire:model="form.date_of_death"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
            </div>
            <h5 style="font-weight: normal">Location Details</h5>
            <hr>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-3">
                <div>
                    <label for="city"
                           class="inline-block mb-2 text-base font-medium">
                        City
                    </label>
                    <input type="text" id="city" wire:model="form.city"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
                <div>
                    <label for="state"
                           class="inline-block mb-2 text-base font-medium">
                        State
                    </label>
                    <input type="text" id="state" wire:model="form.state"
                           class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    >
                </div>
            </div>
            <h5 style="font-weight: normal">Quote Section</h5>
            <hr>
            <div class="my-3">
                <label for="text_or_phrase" class="inline-block mb-2 text-base font-medium">
                    Text or phrase:
                </label>
                <textarea
                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                    id="text_or_phrase" wire:model="form.text_or_phrase" rows="3"></textarea>
                <p class="text-sm">This headline text is the one that shows above the name of
                    the person.</p>
            </div>
            <button type="submit"
                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                Submit
            </button>
        </form>
    </div>
</div>
