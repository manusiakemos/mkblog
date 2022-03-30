<?php

namespace App\Http\Livewire\Halaman;

use Livewire\Component;
use Livewire\WithFileUploads;

class HalamanForm extends Component
{
    use WithFileUploads;

    use HalamanState;

    public $image;

    public $type;

    public function mount($halaman_id = null)
    {
        $this->previous = url()->previous();

        if ($halaman_id) {
            $this->edit($halaman_id);
        }

        $this->breadcrumbs = [
            ["link" => "#", "title" => "Admin", "active" => false],
            ["link" => route('halaman'), "title" => "Halaman", "active" => false],
            ["link" => url('/'), "title" => "Halaman Form", "active" => false],
        ];

        session()->put('active', 'halaman');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        if (count($this->getErrorBag()->all()) > 0) {
            $this->toastMessage = 'Please fix the errors below.';
            $this->showToast = true;
        }
        return view('livewire.halaman.halaman-form')
            ->layout('layouts.admin');
    }
}
