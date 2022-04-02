<?php


namespace App\Http\Livewire\Announcement;


use Livewire\Component;

class AnnouncementPage extends Component
{
    use AnnouncementState;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        $this->breadcrumbs = [
            ["link" => "#", "title" => "Admin", "active" => false],
            ["link" => "#", "title" => trans('messages.announcement'), "active" => true],
        ];
        session()->put('active', 'announcement');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        return view('livewire.announcement.announcement-page')
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
