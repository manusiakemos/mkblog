<?php

namespace App\Http\Livewire\Youtube;

use App\Models\Youtube;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class YoutubeTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "youtube_id";

    public function destroySelected()
    {
        Youtube::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "Youtubes Deleted Successfully", "type" => "success"]);
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
            Column::make('keterangan', 'keterangan')
                ->searchable()
                ->format(function ($value){
                    return Str::limit($value);
                })
                ->sortable(),


            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, Youtube $row) {
                    return view('livewire.youtube._youtube-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Youtube::query();
    }
}
