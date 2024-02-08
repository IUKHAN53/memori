<?php

namespace App\Exports;

use App\Models\QrCode;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QrCodesExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return QrCode::query();
    }

    public function map($qrCode): array
    {
        return [
            $qrCode->identifier,
            $qrCode->secret_phrase,
            url('/').Storage::url($qrCode->path),
            $qrCode->is_assigned ? 'Yes' : 'No'
        ];
    }

    public function headings(): array
    {
        return [
            'Identifier',
            'Secret Phrase',
            'QR Code URL',
            'Assigned?'
        ];
    }
}
