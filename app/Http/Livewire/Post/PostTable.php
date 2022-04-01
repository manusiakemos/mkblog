<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PostTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions= [];

    protected int $index = 0;
    public string $primaryKey = "post_id";

    public function mount()
    {
        $this->bulkActions = [
            'destroySelected' => trans('messages.destroy_selected'),
        ];
    }

    public function destroySelected()
    {
        Post::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => trans('messages.post_destroy') , "type" => "success"]);
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
                ->format(function ($value, $column, Post $row) {
                    return $row->user->name ;
                })
                ->searchable()
                ->sortable(),
            Column::make('category', 'category')
                ->format(function ($value, $column, Post $row) {
                    return $row->category->name ;
                })
                ->searchable()
                ->sortable(),
            Column::make('title', 'title')
                ->searchable()
                ->sortable(),
            Column::make('url', 'url')
                ->searchable()
                ->sortable(),
            Column::make('image', 'image')
                ->format(function ($value, $column, Post $row) {
                    return view('livewire.tables.image',[
                        'path' => asset('/storage/images/post/'.$value)
                    ]);
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make('hit', 'hit')
                ->searchable()
                ->sortable(),
            Column::make('aktif', 'aktif')
                ->format(function ($value, $column, Post $row) {
                    return boolean_text($value, "ya", "tidak");
                })
                ->searchable()
                ->sortable(),


            Column::make("Action")
                ->asHtml()
                ->format(function ($value, $column, Post $row) {
                    return view('livewire.post._post-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Post::with(['user','category']);
    }
}
