<?php


namespace App\Http\Livewire\LinkTerkait;


use Livewire\Component;
use Livewire\WithFileUploads;

class LinkTerkaitPage extends Component
{
    use LinkTerkaitState, WithFileUploads;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        session()->put('active', 'link_terkait');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        return view('livewire.link_terkait.link_terkait-page')
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
