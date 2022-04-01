<?php

namespace App\Http\Livewire\Post;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostForm extends Component
{
    public $image;

    public $type;

    use WithFileUploads;

    use PostState;

    public function mount($id = null)
    {
        $this->previous = url()->previous();

        $this->options['category'] = Category::all()->toArray() ?? [];

        if ($id) {
            $this->edit($id);
        }

        $this->breadcrumbs = [
            ["link" => "#", "title" => "Admin", "active" => false],
            ["link" => route('post'), "title" => trans('messages.post'), "active" => false],
            ["link" => url('/'), "title" => trans('messages.post') . " Form", "active" => false],
        ];

        session()->put('active', 'post');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        if (count($this->getErrorBag()->all()) > 0) {
            $this->toastMessage = 'Please fix the errors below.';
            $this->showToast = true;
        }
        return view('livewire.post.post-form')
            ->layout('layouts.admin');
    }
}
