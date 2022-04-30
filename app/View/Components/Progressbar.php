<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Progressbar extends Component
{

    private String $id;

    /**
     * Create a new component instance.
     * @return void
     **/
    public function __construct(String $id)
    { $this->id = $id; }


    /**
     * Return progressbar id
     * @return String 
     **/ 
    public function getID()
    { return $this->id; }

    
    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\Contracts\View\View|\Closure|string
     **/
    public function render()
    {
        return view('components.progressbar');
    }
}
