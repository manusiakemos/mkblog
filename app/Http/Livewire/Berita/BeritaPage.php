<?php


namespace App\Http\Livewire\Berita;


use Livewire\Component;

class BeritaPage extends Component
{
    use BeritaState;

    public function mount()
    {
        session()->put('active', 'berita');
        session()->put('expanded', 'post');
    }

    public function render()
    {
        return view('livewire.berita.berita-page')
            ->layout('layouts.admin');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
