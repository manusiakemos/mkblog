<?php


namespace App\Http\Livewire\KategoriBerita;


use Livewire\Component;

class KategoriBeritaPage extends Component
{
    use KategoriBeritaState;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
//        dd(KategoriBerita::all());
        session()->put('active', 'kategori_berita');
        session()->put('expanded', 'post');
    }

    public function render()
    {
        return view('livewire.kategori_berita.kategori_berita-page')
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
