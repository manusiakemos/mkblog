<?php


namespace App\Http\Livewire\Halaman;


use Livewire\Component;

class HalamanPage extends Component
{
    use HalamanState;

    public function mount()
    {
        session()->put('active', 'halaman');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        return view('livewire.halaman.halaman-page')
            ->layout('layouts.admin');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
