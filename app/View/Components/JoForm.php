<?php

namespace App\View\Components;

use Illuminate\View\Component;


/*
    reusable is pr-form
*/

class JoForm extends Component
{
    public Array $items;
    public Array $requisitioner;
    public String $requesterDesign = "";
    public String $conforme;
    public String $authofficial;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        Array $items = [
            ['itemno' => '', 'unit' => '', 'description' => '', 'quantity' => '', 'unitcost' => '', 'amount' => ''],
        ], 
        // String $purpose = "", 
        Array $requisitioner = [],
        String $requesterDesign = "",
        String $conforme = "",
        String $authofficial = "",
    )
    {
        $this->items             = $items;
        $this->requisitioner     = $requisitioner;
        $this->requesterDesign   = $requesterDesign; 
        $this->conforme          = $conforme; 
        $this->authofficial         = $authofficial; 
    }


    /**
     * Returns Array of items
     * @return Array
     */
    public function getItems() : Array
    { return $this->items; }

    /**
     * Returns requisitioner name
     * @return String
     **/
    public function getRequisitionerName()
    {
        if (!(array) $this->requisitioner)
            return "";

        return $this->requisitioner['lastname'] . ', ' . $this->requisitioner['firstname'] . ' ' . $this->requisitioner['middleinitial'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.jo-form');
    }
}
