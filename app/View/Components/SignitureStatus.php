<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SignitureStatus extends Component
{
    private Int $personelstatus_id;
    private String $personelstatus;

    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct(Int $personelstatusid, String $personelstatus)
    {
        $this->personelstatus_id = $personelstatusid;
        $this->personelstatus    = $personelstatus;
    }

    public function personelStatusID()
    { return $this->personelstatus_id; }

    public function personelStatus()
    { return $this->personelstatus; }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.signiture-status');
    }
}
