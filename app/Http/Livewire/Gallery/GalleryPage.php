<?php


namespace App\Http\Livewire\Gallery;


use Livewire\Component;

class GalleryPage extends Component
{
    use GalleryState;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        session()->put('active', 'gallery');
        session()->put('expanded', 'gallery');
    }

    public function render()
    {
        return view('livewire.gallery.gallery-page')
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
