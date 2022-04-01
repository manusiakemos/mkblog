<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CategoryTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [];

    protected int $index = 0;
    public string $primaryKey = "category_id";

    public function mount()
    {
        $this->bulkActions = [
            'destroySelected' => trans('messages.destroy_selected'),
        ];
    }

    public function destroySelected()
    {
        Category::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => trans('messages.category_destroy'), "type" => "success"]);
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

            Column::make('name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('active', 'active')
                ->format(function ($value, $column, Category $row) {
                    return boolean_text($value);
                })
                ->searchable()
                ->sortable(),
            Column::make("Action")
                ->addClass("flex justify-center")
                ->asHtml()
                ->format(function ($value, $column, Category $row) {
                    return view('livewire.category._category-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Category::query();
    }
}
