<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\QrCode;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class QrCodes extends DataTableComponent
{
    protected $model = QrCode::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Identifier", "identifier")
                ->sortable(),
            Column::make("Secret phrase", "secret_phrase")
                ->sortable(),
            Column::make('Path', 'path')
                ->sortable()
                ->format(function($value, $row) {
                    return $row->path;
                }),
            ImageColumn::make('Qr code')
                ->location(function($row) {
                    return Storage::url($row->path);
                })
                ->attributes(function($row) {
                    return [
                        'alt' => 'QR Code',
                        'style' => 'width: 75px; height: 75px;',
                    ];
                }),
            BooleanColumn::make("Is assigned", "is_assigned")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Delete')
                ->location(fn($row) => 'wire:click=delete('.$row->identifier.')'),
        ];

    }

    public function query()
    {
        return QrCode::query();
    }
}
