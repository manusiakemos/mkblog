<?php

namespace App\Http\Livewire\CustomPage;

use Livewire\Component;

class CustomPageForm extends Component
{
    public $type;

    use CustomPageState;

    public function mount($custom_page_id = null)
    {
        if ($custom_page_id) {
            $this->edit($custom_page_id);
        }

        $this->breadcrumbs = [
            ["link" => "#", "title" => "Admin", "active" => false],
            ["link" => route('custom-page'), "title" => trans('messages.page'), "active" => false],
            ["link" => url('/'), "title" => "CustomPage Form", "active" => false],
        ];

        session()->put('active', 'custom-page');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        if (count($this->getErrorBag()->all()) > 0) {
            $this->toastMessage = 'Please fix the errors below.';
            $this->showToast = true;
        }
        return view('livewire.custom_page.custom_page-form')
            ->layout('layouts.admin');
    }
}
