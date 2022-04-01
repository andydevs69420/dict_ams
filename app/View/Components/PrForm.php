<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PrForm extends Component
{
    public Array $items;
    public String $purpose;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Array $items = [], String $purpose = "")
    {
        $this->items = $items;
        $this->purpose = $purpose;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pr-form');
    }
}
