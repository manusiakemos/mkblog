<?php

namespace App\Http\Livewire\Halaman;

use App\Models\Halaman;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class HalamanTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "halaman_id";

    public function destroySelected()
    {
        Halaman::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "Halamans Deleted Successfully", "type" => "success"]);
    }

    public function columns(): array
    {
        if ($this->page > 1) {
            $this->index = ($this->page - 1) * $this->perPage;
        } else {
            $this->index = 0;
        }

        return [
            Column::make(__('No.'))->format(function () {
                return ++$this->index;
            }),

            Column::make('judul', 'judul')
                ->searchable()
                ->sortable(),
            Column::make('custom', 'custom')
                ->format(function ($value) {
                    return boolean_text($value, 'ya', 'tidak');
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make('gambar', 'gambar')
                ->format(function ($value) {
                    $path = asset('storage/images/halaman/' . $value);
                    return view('livewire.tables.image', compact('path'));
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make('url', 'url')
                ->searchable()
                ->sortable(),
            Column::make('aktif', 'aktif')
                ->format(function ($value) {
                    return boolean_text($value);
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, Halaman $row) {
                    return view('livewire.halaman._halaman-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Halaman::query();
    }
}
