<?php

namespace App\View\Components;

use Illuminate\View\Component;


/*
    ****** reusable pr-form ******
    | IMPLEMENT encapsulation
    ;
*/

class PrForm extends Component
{
    private Array $items;
    private String $purpose;
    private Array $budgetOfficer;
    private Array $requisitioner;
    private Array $recommendingApproval;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        Array $items = [
            /***
             * dapat naay default item
             * mao ni si item 1
             */
            ['', '', '', '', '', '']
        ], 
        String $purpose              = "", 
        Array  $budgetOfficer        = [], 
        Array  $requisitioner        = [], 
        Array  $recommendingApproval = [],
    )
    {
        $this->items                = $items;
        $this->purpose              = $purpose;
        $this->budgetOfficer        = $budgetOfficer;
        $this->requisitioner        = $requisitioner;
        $this->recommendingApproval = $recommendingApproval;
    }

    // =============== REQUISITIONER METHODS ===============
     /**
     * Returns Array of items
     * @return Array
     */
    public function getItems() : Array
    { return $this->items; }

    /**
     * Returns PR-Form Purpose
     * @return String
     */
    public function getPurpose() : String
    { return $this->purpose; }

    /** 
     * Returns requisitioner id
     * @return Int
     */
    public function getRequisitionerAccessLevelId() : Int
    { return (Int) $this->requisitioner['accesslevel_id']; }

    /**
     * Returns requisitioner name eg: LN, FN MN
     * @return String
     */
    public function getRequisitionerName() : String 
    {
        if (!(array) $this->requisitioner)
            return "";

        return $this->requisitioner['lastname'] . ", " . $this->requisitioner['firstname'] . " " . $this->requisitioner['middleinitial'];
    }

    /**
     * Returns requisitioner designation eg: designation, Accesslevel
     * @return String
     */
    public function getRequisitionerDesignation() : String
    {
        if (!(array) $this->requisitioner)
            return "...";

        return $this->requisitioner['designation_name'] . ", " . $this->requisitioner['accesslevel_name'];
    }

    // =============== RECOMMENDING APPROVAL METHODS ===============

    /** 
     * Returns recommending approval id
     * @return Int
     */
    public function getRecommendingApprovalAccessLevelId() : Int
    { return (Int) $this->recommendingApproval['accesslevel_id']; }

    /**
     * Returns reccomending approval name eg: LN, FN MN
     * @return String
     */
    public function getRecommendingApprovalName() : String 
    {
        if (!(array) $this->recommendingApproval)
            return "";

        return $this->recommendingApproval['lastname'] . ", " . $this->recommendingApproval['firstname'] . " " . $this->recommendingApproval['middleinitial'];
    }

    /**
     * Returns recommending designation eg: designation, Accesslevel
     * @return String
     */
    public function getRecommendingApprovalDesignation() : String
    {
        if (!(array) $this->recommendingApproval)
            return "...";

        return $this->recommendingApproval['designation_name'] . ", " . $this->recommendingApproval['accesslevel_name'];
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
