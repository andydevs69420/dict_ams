<?php

namespace App\View\Components;

use Illuminate\View\Component;


/*
    reusable is pr-form
*/

class PrForm extends Component
{
    public Array  $items;
    public String $purpose;
    public Int    $requesterId;
    public String $requester;
    public String $requesterDesign;
    public String $recommendingApproval;
    public String $recommendingApprovalDesign;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        // dapat naay default item
        // mao ni si item 1
        Array $items = [['', '', '', '', '', '']], 
        String $purpose = "", 
        Int $requesterId = 0,
        String $requester = "",
        String $requesterDesign = "",
        String $recommendingApproval = "",
        String $recommendingApprovalDesign = "",
    )
    {
        $this->items = $items;
        $this->purpose = $purpose;
        $this->requesterId = $requesterId;
        $this->requester = $requester;
        $this->requesterDesign = $requesterDesign; 
        $this->recommendingApproval = $recommendingApproval; 
        $this->recommendingApprovalDesign = $recommendingApprovalDesign; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pr-form');
    }
}
