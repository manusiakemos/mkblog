<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Button extends Component
{
    public $variant;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($variant = "normal")
    {
        $this->variant = $variant;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.button');
    }
}
