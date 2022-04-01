<?php


namespace App\Http\Livewire\Post;


use Livewire\Component;

class PostPage extends Component
{
    use PostState;

    public function mount()
    {
        session()->put('active', 'berita');
        session()->put('expanded', 'post');

        $this->breadcrumbs = [
            ["link" => "#", "title" => "Admin", "active" => false],
            ["link" => "#", "title" => "Berita", "active" => true],
        ];
    }

    public function render()
    {
        return view('livewire.post.post-page')
            ->layout('layouts.admin');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
