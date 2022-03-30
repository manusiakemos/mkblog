<?php


namespace App\Http\Livewire\Pengumuman;


use Livewire\Component;

class PengumumanPage extends Component
{
    use PengumumanState;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        session()->put('active', 'pengumuman');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        return view('livewire.pengumuman.pengumuman-page')
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
