<div>
    <div class="flex justify-end items-center gap-3 md:flex-row flex-col mb-5">
        <div class="flex flex-row gap-2">
            <x-text-input type="number" wire:model="number" placeholder="Amount to Generate"
                          class="w-full"></x-text-input>
            <button
                class="w-[20px] text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                wire:click="creteBatchQr">+
            </button>
            <button
                class="w-[20px] text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                wire:click="exportQrCodes">Export
            </button>
        </div>
    </div>
    <table class="display stripe group text-start" style="width:100%">
        <thead>
        <tr>
            <th class=" text-start">QR Code</th>
            <th class=" text-start">Download QR</th>
            <th class=" text-start">Identifier</th>
            <th class=" text-start">Secret Phrase</th>
            <th class=" text-start">Assigned?</th>
            <th class=" text-start">Created At</th>
            <th class=" text-start">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($qrCodes as $qrCode)
            <tr>
                <td>
                    <img src="{{Storage::url($qrCode->path)}}" alt="QR Code" class="w-auto h-14 ml-3">
                </td>
                <td class="text-center">
                    <a href="{{Storage::url($qrCode->path)}}" download><img src="{{asset('assets/images/download.svg')}}" alt=""></a>
                </td>
                <td class="ltr:!text-left rtl:!text-right">{{$qrCode->identifier}}</td>
                <td>{{$qrCode->secret_phrase}}</td>
                <td><span
                        class="text-{{$qrCode->is_assigned ? 'purple' : 'green'}}-500">{{$qrCode->is_assigned ? 'Yes' : 'No'}}</span>
                </td>
                <td>
                    <span class="text-gray-500">{{$qrCode->created_at->format('d M Y')}}</span>
                </td>
                <td>
                    <div class="flex items text-center">
                        <button wire:click="deleteQr('{{$qrCode->id}}')"
                           class="text-red-500 hover:text-red-600 focus:text-red-600 dark:text-red-400 dark:hover:text-red-500 dark:focus:text-red-500">
                            <img src="{{asset('assets/images/trash.svg')}}" alt="">
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination mt-3">
        {{ $qrCodes->links() }}
    </div>
</div>
