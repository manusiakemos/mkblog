<?php


namespace App\Http\Livewire\Contact;


use Livewire\Component;
use Livewire\WithFileUploads;

class ContactPage extends Component
{
    use ContactState, WithFileUploads;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        $this->breadcrumbs = [
            ["link" => "#", "title" => "Admin", "active" => false],
            ["link" => "#", "title" => trans('messages.contact'), "active" => true],
        ];
        session()->put('active', 'contact');
        session()->put('expanded', 'contact');
    }

    public function render()
    {
        return view('livewire.contact.contact-page')
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
