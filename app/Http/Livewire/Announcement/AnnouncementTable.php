<?php

namespace App\Http\Livewire\Announcement;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AnnouncementTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [];

    protected int $index = 0;
    public string $primaryKey = "announcement_id";

    public function mount()
    {
        $this->bulkActions = [
            'destroySelected' => trans('messages.destroy_selected'),
        ];
    }

    public function destroySelected()
    {
        Announcement::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "Pengumumans Deleted Successfully", "type" => "success"]);
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
            Column::make('date', 'date')
                ->searchable()
                ->sortable(),
            Column::make('repeat', 'repeat')
                ->format(function ($value){
                    return boolean_text($value, trans('yes'), trans('no'));
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
                ->format(function ($value, $column, Announcement $row) {
                    return view('livewire.announcement._announcement-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Announcement::query();
    }
}
