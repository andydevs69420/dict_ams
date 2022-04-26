<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Topbar extends Component
{
    private String $username;

    
    /**
     * Create a new component instance.
     * @return void
     **/
    public function __construct(String $username)
    {
        $this->username = $username;
    }


    /**
     * Returns user's username
     * @return String
     **/
    public function getUsername()
    { return $this->username; }


    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\Contracts\View\View|\Closure|string
     **/
    public function render()
    {
        return view('components.topbar');
    }
}
