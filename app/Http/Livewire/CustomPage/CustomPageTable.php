<?php

namespace App\Http\Livewire\CustomPage;

use App\Models\CustomPage;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CustomPageTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "custom_page_id";

    public function destroySelected()
    {
        CustomPage::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "CustomPages Deleted Successfully", "type" => "success"]);
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

            Column::make('Title', 'title')
                ->searchable()
                ->sortable(),
            Column::make('URL', 'url')
                ->format(function ($value, $col, $row) {
                    return view('livewire.tables.link', [
                        'path' => url('/page/' . $value),
                        'label' => 'view page'
                    ]);
                })
                ->searchable()
                ->sortable(),
            Column::make('active', 'active')
                ->format(function ($value){
                    return boolean_text($value, trans('yes'), trans('no'));
                })
                ->searchable()
                ->sortable(),
            Column::make("Action")
                ->addClass("flex items-center justify-center h-16")
                ->asHtml()
                ->format(function ($value, $column, CustomPage $row) {
                    return view('livewire.custom_page._custom_page-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return CustomPage::query();
    }
}
