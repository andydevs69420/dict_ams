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
    public Array $requesterDesign;
    public String $conforme;
    public Array $authofficial;

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
        Array $requisitioner    = [],
        Array $requesterDesign  = [],
        String $conforme        = "",
        Array $authofficial     = [],
    )
    {
        $this->items             = $items;
        $this->requisitioner     = $requisitioner;
        $this->requesterDesign   = $requesterDesign; 
        $this->conforme          = $conforme; 
        $this->authofficial      = $authofficial; 
    }


    /**
     * Returns Array of items
     * @return Array
     */
    public function getItems() : Array
    { return $this->items; }

    // =================================== REQUISITIONER ===================================

    /**
     * Returns accesslevel id
     * @return String
     **/
    public function getRequisitionerId()
    {
        if (!(array) $this->requisitioner)
            return "";

        return $this->requisitioner['user_id'];
    }

    /**
     * Returns accesslevel id
     * @return String
     **/
    public function getRequisitionerAccesslevelId()
    {
        if (!(array) $this->requisitioner)
            return "";

        return $this->requisitioner['accesslevel_id'];
    }

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

    // =================================== AUTHORIZED OFFICIAL ===================================

    /**
     * Returns accesslevel id
     * @return String
     **/
    public function getAuthorizedOfficialId()
    {
        if (!(array) $this->authofficial)
            return "";

        return $this->authofficial['user_id'];
    }

    /**
     * Returns accesslevel id
     * @return String
     **/
    public function getAuthOfficialAccesslevelId()
    {
        if (!(array) $this->authofficial)
            return "";

        return $this->authofficial['accesslevel_id'];
    }

    /**
     * Returns authorized official name
     * @return String
     **/
    public function getAuthorizedOfficialName()
    {
        if (!(array) $this->authofficial)
            return "";

        return $this->authofficial['lastname'] . ', ' . $this->authofficial['firstname'] . ' ' . $this->authofficial['middleinitial'];
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
