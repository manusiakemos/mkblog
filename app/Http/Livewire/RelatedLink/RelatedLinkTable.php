<?php

namespace App\Http\Livewire\RelatedLink;

use App\Models\RelatedLink;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RelatedLinkTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions;

    protected int $index = 0;
    public string $primaryKey = "related_link_id";

    public function mount()
    {
        $this->bulkActions = [
            'destroySelected' => trans('messages.destroy_selected'),
        ];
    }

    public function destroySelected()
    {
        RelatedLink::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => trans('messages.related_link_destroy'), "type" => "success"]);
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

            Column::make('label', 'label')
                ->searchable()
                ->sortable(),
            Column::make('url', 'url')
                ->format(function ($value, $column, RelatedLink $row){
                    return view('livewire.tables.link', [
                        'path' => $value,
                        'label' => $row->label
                    ]);
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make('icon', 'icon')
                ->format(function ($value, $column, RelatedLink $row){
                    return view('livewire.tables.image', [
                        'path' => asset('images/related-link/'.$value),
                    ]);
                })
                ->asHtml()
                ->searchable()
                ->sortable(),

            Column::make("Action")
                ->addClass('flex justify-center items-center h-16')
                ->asHtml()
                ->format(function ($value, $column, RelatedLink $row) {
                    return view('livewire.related_link._related_link-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return RelatedLink::query();
    }
}
