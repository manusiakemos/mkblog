<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Home extends Component
{
    public array $breadcrumbs = [];

    public function mount()
    {
        session()->put('active', 'home');
        session()->put('expanded', 'home');
    }

    public function render()
    {
        return view('livewire.admin.home')
            ->layout('layouts.admin');
    }
}
