<?php


namespace App\Http\Livewire\Category;


use Livewire\Component;

class CategoryPage extends Component
{
    use CategoryState;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        $this->breadcrumbs = [
            ["link" => "#", "title" => "Admin", "active" => false],
            ["link" => "#", "title" => trans('messages.category'), "active" => true],
        ];

        session()->put('active', 'category');
        session()->put('expanded', 'post');
    }

    public function render()
    {
        return view('livewire.category.category-page')
            ->layout('layouts.admin');
    }

    public function save()
    {
        $this->updateMode ? $this->update() : $this->store();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
