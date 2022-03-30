<?php

namespace App\Http\Livewire\KategoriBerita;

use App\Models\KategoriBerita;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class KategoriBeritaTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "kategori_id";

    public function destroySelected()
    {
        KategoriBerita::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "KategoriBeritas Deleted Successfully", "type" => "success"]);
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

            Column::make('nama', 'nama')
                ->searchable()
                ->sortable(),
            Column::make('aktif', 'aktif')
                ->format(function ($value, $column, KategoriBerita $row) {
                    return boolean_text($value);
                })
                ->searchable()
                ->sortable(),
            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, KategoriBerita $row) {
                    return view('livewire.kategori_berita._kategori_berita-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return KategoriBerita::query();
    }
}
