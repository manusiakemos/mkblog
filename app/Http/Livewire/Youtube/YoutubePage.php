<?php


namespace App\Http\Livewire\Youtube;


use Livewire\Component;

class YoutubePage extends Component
{
    use YoutubeState;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        session()->put('active', 'youtube');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        return view('livewire.youtube.youtube-page')
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
