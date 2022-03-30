<?php


namespace App\Http\Livewire\Menu;


use Livewire\Component;

class MenuPage extends Component
{
    use MenuState;

    protected $listeners = ['create', 'edit'];

    public function mount()
    {
        session()->put('active', 'menu');
        session()->put('expanded', 'admin');
    }

    public function render()
    {
        return view('livewire.menu.menu-page')
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
