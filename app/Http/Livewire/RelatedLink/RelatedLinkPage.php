<?php


namespace App\Http\Livewire\RelatedLink;


use Livewire\Component;
use Livewire\WithFileUploads;

class RelatedLinkPage extends Component
{
    use RelatedLinkState, WithFileUploads;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        session()->put('active', 'related-link');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        return view('livewire.related_link.related_link-page')
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
