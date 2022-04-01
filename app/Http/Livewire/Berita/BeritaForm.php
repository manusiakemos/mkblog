<?php

namespace App\Http\Livewire\Berita;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class BeritaForm extends Component
{
    public $image;
    //public $myFile;

    use WithFileUploads;

    public $type;

    use BeritaState;

    public function mount($id = null)
    {
        $this->previous = url()->previous();

        $this->options['kategori_berita'] = Category::all()->toArray() ?? [];

        if ($id) {
            $this->edit($id);
        }

        $this->breadcrumbs = [
            ["link" => "#", "title" => "Admin", "active" => false],
            ["link" => route('berita'), "title" => "Berita", "active" => false],
            ["link" => url('/'), "title" => "Berita Form", "active" => false],
        ];

        session()->put('active', 'berita');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        if (count($this->getErrorBag()->all()) > 0) {
            $this->toastMessage = 'Please fix the errors below.';
            $this->showToast = true;
        }
        return view('livewire.berita.berita-form')
            ->layout('layouts.admin');
    }
}
