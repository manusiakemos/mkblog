<?php

namespace App\Http\Livewire\Menu;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Menu;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class MenuTable extends DataTableComponent
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
        Menu::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "Menus Deleted Successfully", "type"=>"success"]);
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

            Column::make('Parent', 'parent_id')
    ->searchable()
    ->sortable(),
Column::make('type', 'type')
    ->searchable()
    ->sortable(),
Column::make('Nama', 'name')
    ->searchable()
    ->sortable(),
Column::make('url', 'url')
    ->searchable()
    ->sortable(),


            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, Menu $row) {
                    return view('livewire.menu._menu-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
       return Menu::query();
    }
}
