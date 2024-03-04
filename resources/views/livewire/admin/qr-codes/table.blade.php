<div>
    <div class="flex justify-end items-center gap-3 md:flex-row flex-col mb-5">
        <div class="flex flex-row gap-2">
            <x-text-input type="number" wire:model="number"
                          placeholder="{{ __('all.amount_to_generate') }}"
                          class="w-full"></x-text-input>
            <button
                class="w-[20px] text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                wire:click="creteBatchQr">+
            </button>
            <button
                class="w-[20px] text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                wire:click="exportQrCodes">{{ __('all.export') }}
            </button>
        </div>
    </div>
    <table class="items-center bg-transparent w-full border-collapse ">
        <thead>
        <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">{{ __('all.qr_code') }}</th>
{{--            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">{{ __('all.download_qr') }}</th>--}}
{{--            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">{{ __('all.identifier') }}</th>--}}
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">{{ __('all.url') }}</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">{{ __('all.assigned') }}</th>
{{--            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">{{ __('all.created_at') }}</th>--}}
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">{{ __('all.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($qrCodes as $qrCode)
            <tr>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
                    <img src="{{Storage::url($qrCode->path)}}" alt="QR Code" class="w-auto h-14 ml-3">
                </td>
{{--                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">--}}
{{--                    <a href="{{Storage::url($qrCode->path)}}" download><img--}}
{{--                            src="{{asset('assets/images/download.svg')}}" alt="Download"></a>--}}
{{--                </td>--}}
{{--                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4" class=" ltr:!text-left rtl:!text-right">{{$qrCode->identifier}}</td>--}}
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    <a href="{{route('qr-code.verify', ['identifier' => $qrCode->identifier])}}" target="_blank"
                    class="text-custom-500">Click to open
                    </a>
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><span
                        class="text-{{$qrCode->is_assigned ? 'purple' : 'green'}}-500">{{$qrCode->is_assigned ? 'Yes' : 'No'}}</span>
                </td>
{{--                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">--}}
{{--                    <span class="text-gray-500">{{$qrCode->created_at->format('d M Y')}}</span>--}}
{{--                </td>--}}
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                    <div class="flex items-center justify-center">
                        <button wire:click="deleteQr('{{$qrCode->id}}')"
                                wire:confirm="{{__('all.qr_code_delete?')}}"
                                class="text-red-500 hover:text-red-600 focus:text-red-600 dark:text-red-400 dark:hover:text-red-500 dark:focus:text-red-500">
                            <img src="{{asset('assets/images/trash.svg')}}" alt="Delete">
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
