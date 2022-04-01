<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class GalleryTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [];

    protected int $index = 0;
    public string $primaryKey = "gallery_id";

    public function mount()
    {
        $this->bulkActions =  [
            'destroySelected' => trans('messages.destroy_selected'),
        ];
    }

    public function destroySelected()
    {
        Gallery::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => trans('messages.gallery_destroy'), "type" => "success"]);
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

            Column::make('title', 'title')
                ->searchable()
                ->sortable(),
            Column::make('description', 'desc')
                ->searchable()
                ->sortable(),
            Column::make('slug', 'slug')
                ->searchable()
                ->sortable(),
            Column::make('filename', 'filename')
                ->format(function ($value) {
                    $path = asset('storage/images/gallery/' . $value);
                    return view('livewire.tables.image', compact('path'));
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, Gallery $row) {
                    return view('livewire.gallery._gallery-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Gallery::query();
    }
}
