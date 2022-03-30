<?php

namespace App\Http\Livewire\LinkTerkait;

use App\Models\LinkTerkait;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LinkTerkaitTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "link_terkait_id";

    public function destroySelected()
    {
        LinkTerkait::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "LinkTerkaits Deleted Successfully", "type" => "success"]);
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
                ->format(function ($value, $column, LinkTerkait $row){
                    return view('livewire.tables.link', [
                        'path' => $value,
                        'label' => $row->label
                    ]);
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make('icon', 'icon')
                ->format(function ($value, $column, LinkTerkait $row){
                    return view('livewire.tables.image', [
                        'path' => asset('images/link-terkait/'.$value),
                    ]);
                })
                ->asHtml()
                ->searchable()
                ->sortable(),

            Column::make("Action")
                ->addClass('flex flex-col items-center grow')
                ->asHtml()
                ->format(function ($value, $column, LinkTerkait $row) {
                    return view('livewire.link_terkait._link_terkait-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return LinkTerkait::query();
    }
}
