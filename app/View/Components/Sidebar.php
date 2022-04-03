<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public String $accessLevelId;
    /**
     * Create a new component instance.
     * @param int $accessLevelId
     * @return void
     */
    public function __construct(String $accessLevelId)
    {
        $this->accessLevelId = $accessLevelId;
    }

    /**
     * 
     * @param String $path
     * @return String
     * 
     */
    public function isPathMatch(String $path)
    {
        return (request()->is($path)) ? 'active-link' : 'inactive-link';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
