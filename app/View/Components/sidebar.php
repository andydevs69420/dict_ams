<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sidebar extends Component
{
    public $accessLevelId;
    /**
     * Create a new component instance.
     * @param int $accessLevelId
     * @return void
     */
    public function __construct($accessLevelId)
    {
        $this->accessLevelId = $accessLevelId;
    }

    /**
     * 
     * @param String $path
     * @return String
     * 
     */
    public function is_path_match($path)
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
