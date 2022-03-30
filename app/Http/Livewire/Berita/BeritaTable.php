<?php

namespace App\Http\Livewire\Berita;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BeritaTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "id";

    public function destroySelected()
    {
        Berita::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "Beritas Deleted Successfully", "type" => "success"]);
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

            Column::make('user', 'user_id')
                ->format(function ($value, $column, Berita $row) {
                    return $row->user->name ;
                })
                ->searchable()
                ->sortable(),
            Column::make('kategori', 'kategori_id')
                ->format(function ($value, $column, Berita $row) {
                    return $row->kategori->nama ;
                })
                ->searchable()
                ->sortable(),
            Column::make('judul', 'judul')
                ->searchable()
                ->sortable(),
            Column::make('url', 'url')
                ->searchable()
                ->sortable(),
            Column::make('gambar', 'gambar')
                ->format(function ($value, $column, Berita $row) {
                    return "<a target='_blank' href='".asset('/storage/images/berita/'.$value)."'>
                                <img class='h-12' alt='".$value."' src='".asset('/storage/images/berita/'.$value)."'/>
                            </a>";
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make('hit', 'hit')
                ->searchable()
                ->sortable(),
            Column::make('aktif', 'aktif')
                ->format(function ($value, $column, Berita $row) {
                    return boolean_text($value, "ya", "tidak");
                })
                ->searchable()
                ->sortable(),


            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, Berita $row) {
                    return view('livewire.berita._berita-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Berita::with(['user','kategori']);
    }
}
