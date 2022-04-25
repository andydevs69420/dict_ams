<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    private int $accessLevelId;

    
    /**
     * Create a new component instance.
     * @param int $accessLevelId
     * @return void
     **/
    public function __construct(int $accessLevelId)
    {
        $this->accessLevelId = $accessLevelId;
    }


    /**
     * Check if path matched
     * @param String $path
     * @return String
     **/
    public function isPathMatch(String $path)
    {
        return (request()->is($path)) ? 'active-link' : 'inactive-link';
    }


    /**
     * Return user accesslevelid
     * @return Int
     **/
    public function getAccesslevelId()
    { return $this->accessLevelId; }


    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\Contracts\View\View|\Closure|string
     **/
    public function render()
    {
        return view('components.sidebar');
    }
}
