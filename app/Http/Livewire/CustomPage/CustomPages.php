<?php


namespace App\Http\Livewire\CustomPage;

use Livewire\Component;

class CustomPages extends Component
{
    use CustomPageState;

    public function mount()
    {
        session()->put('active', 'custom-page');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        return view('livewire.custom_page.custom_page-page')
            ->layout('layouts.admin');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
