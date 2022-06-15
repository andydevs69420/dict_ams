<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AccessName extends Component
{
    private String $accesslevel;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $accesslevel)
    {
        //
        $this->accesslevel = $accesslevel;
    }


    public function getAccesslevel()
    { return $this->accesslevel; }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.access-name');
    }
}
