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

    public array $bulkActions = [];

    protected int $index = 0;
    public string $primaryKey = "youtube_id";

    public function mount()
    {
        $this->bulkActions = [
            'destroySelected' => trans('messages.destroy_selected'),
        ];
    }

    public function destroySelected()
    {
        Youtube::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => __('messages.youtube_destroy'), "type" => "success"]);
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
            Column::make('desc', 'desc')
                ->searchable()
                ->format(function ($value) {
                    return Str::limit($value);
                })
                ->sortable(),


            Column::make("Action")
                ->addClass("flex items-center justify-center h-16")
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
