<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StepProgress extends Component
{
    private $frp_data;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($frp)
    {
        $this->frp_data = $frp;
    }

    /**
     * Get' form required peronel data
     * @return Array
     **/
    public function getFRPData()
    {
      return $this->frp_data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.step-progress');
    }
}
