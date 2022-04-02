<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ContactTable extends DataTableComponent
{

    //public string $defaultSortColumn = '';
    //public string $defaultSortDirection = 'asc';
    public bool $perPageAll = true;

    public array $bulkActions = [
        'destroySelected' => 'Hapus Data Terpilih',
    ];

    protected int $index = 0;
    public string $primaryKey = "contact_id";

    public function destroySelected()
    {
        Contact::whereIn($this->primaryKey, $this->selectedRowsQuery()->pluck($this->primaryKey))->delete();
        $this->emit("showToast", ["message" => "Kontaks Deleted Successfully", "type" => "success"]);
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
            Column::make('icon', 'icon')
                ->format(function ($value){
                    $path = asset('storage/images/contact/'.$value);
                    return view('livewire.tables.image', compact('path'));
                })
                ->asHtml()
                ->searchable()
                ->sortable(),
            Column::make('content', 'content')
                ->searchable()
                ->sortable(),
            Column::make("Action")
                ->addClass("flex items-center justify-center h-16")
                ->asHtml()
                ->format(function ($value, $column, Contact $row) {
                    return view('livewire.contact._contact-action', compact('row'));
                }),
        ];
    }

    public function query(): Builder
    {
        return Contact::query();
    }
}
