<?php

namespace App\Livewire\Admin\QrCodes;

use App\Exports\QrCodesExport;
use App\Models\QrCode as QrCodeModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Table extends Component
{
    use WithPagination;
    public int $number = 1;

    public function creteBatchQr(): void
    {
        for ($i = 0; $i < $this->number; $i++) {
            $identifier = Str::uuid()->toString();
            $secretPhrase = Str::random();

            $url = route('qr-code.verify', ['identifier' => $identifier]);
            $filePath = 'qrcodes/' . $identifier . '.svg';
            Storage::disk('public')->makeDirectory('qrcodes');
            $qrCodeContent = QrCode::size(300)->generate($url);
            Storage::disk('public')->put($filePath, $qrCodeContent);

            QrCodeModel::create([
                'identifier' => $identifier,
                'secret_phrase' => $secretPhrase,
                'account_id' => null,
                'path' => $filePath,
                'is_assigned' => false,
            ]);
        }

        $this->dispatch('contentChanged');

    }

    public function render()
    {
        return view('livewire.admin.qr-codes.table')->with(['qrCodes'=> QrCodeModel::latest()->simplePaginate(15)]);
    }


    public function deleteQr($id)
    {
        $qrCode = QrCodeModel::find($id);
        Storage::disk('public')->delete($qrCode->path);
        $qrCode->delete();
        $this->dispatch('contentChanged');
    }

    public function exportQrCodes()
    {
        $fileName = 'qr_codes_export.xlsx';

        return Excel::download(new QrCodesExport, $fileName);
    }
}
