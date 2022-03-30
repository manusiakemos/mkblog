<?php

namespace App\Http\Livewire\Pengumuman;

use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PengumumanTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "pengumuman_id";

    public function destroySelected()
    {
        Pengumuman::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "Pengumumans Deleted Successfully", "type" => "success"]);
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
            Column::make('tanggal', 'tanggal')
                ->searchable()
                ->sortable(),
            Column::make('rutin', 'rutin')
                ->searchable()
                ->sortable(),
            Column::make('aktif', 'aktif')
                ->searchable()
                ->sortable(),
            Column::make('isi', 'isi')
                ->searchable()
                ->sortable(),


            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, Pengumuman $row) {
                    return view('livewire.pengumuman._pengumuman-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Pengumuman::query();
    }
}
