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
    private String $warningMessage;
    private Array $items;
    private String $purpose;
    private Array $budgetOfficer;
    private Array $requisitioner;
    private Array $recommendingApproval;
    /**
     * Create a new component instance.
     * @param String warningMessage
     * @param Array items
     * @param String purpose
     * @param Array budgetOfficer
     * @param Array requisitioner
     * @param Array recommendingApproval
     * @return void
     **/
    public function __construct(
        String $warningMessage = '',
        Array $items = [
            /*
                dapat naay default item
                mao ni si item 1
             */
            ['stockno' => '', 'unit' => '', 'item' => '', 'quantity' => '', 'unitcost' => '', 'totalcost' => ''],
        ], 
        String $purpose              = '', 
        Array  $budgetOfficer        = [], 
        Array  $requisitioner        = [], 
        Array  $recommendingApproval = [],
    )
    {
        $this->warningMessage       = $warningMessage;
        $this->items                = $items;
        $this->purpose              = $purpose;
        $this->budgetOfficer        = $budgetOfficer;
        $this->requisitioner        = $requisitioner;
        $this->recommendingApproval = $recommendingApproval;
    }

    
    /**
     * Returns Waring message
     * @return String
     **/
    public function getWarningMessage()
    { return $this->warningMessage; }


    /**
     * Returns Array of items
     * @return Array
     **/
    public function getItems()
    { return $this->items; }


    /**
     * Returns PR-Form Purpose
     * @return String
     **/
    public function getPurpose() : String
    { return $this->purpose; }

    // =============== BUDGET OFFICER METHODS===============


    /** 
     * Returns budget officer id
     * @return Int
     **/
    public function getBudgetOfficerId()
    { return (Int) $this->budgetOfficer['user_id']; }


    /** 
     * Returns budget officer id
     * @return Int
     **/
    public function getBudgetOfficerAccessLevelId()
    { return (Int) $this->budgetOfficer['accesslevel_id']; }


    /**
     * Returns budget officer name eg: LN, FN MN
     * @return String
     **/
    public function getBudgetOfficerName()
    {
        if (!(array) $this->budgetOfficer)
            return "";

        return $this->budgetOfficer['lastname'] . ', ' . $this->budgetOfficer['firstname'] . ' ' . $this->budgetOfficer['middleinitial'];
    }


    /**
     * Returns budget officer designation eg: designation, Accesslevel
     * @return String
     **/
    public function getBudgetOfficerDesignation()
    {
        if (!(array) $this->budgetOfficer)
            return "";

        return $this->budgetOfficer['designation_name'] . ', ' . $this->budgetOfficer['accesslevel_name'];
    }

    // =============== REQUISITIONER METHODS ===============

    /** 
     * Returns requisitioner id
     * @return Int
     **/
    public function getRequisitionerId()
    { return (Int) $this->requisitioner['user_id']; }


    /** 
     * Returns requisitioner access level id
     * @return Int
     **/
    public function getRequisitionerAccessLevelId()
    { return (Int) $this->requisitioner['accesslevel_id']; }


    /**
     * Returns requisitioner name eg: LN, FN MN
     * @return String
     **/
    public function getRequisitionerName()
    {
        if (!(array) $this->requisitioner)
            return "";

        return $this->requisitioner['lastname'] . ', ' . $this->requisitioner['firstname'] . ' ' . $this->requisitioner['middleinitial'];
    }


    /**
     * Returns requisitioner designation eg: designation, Accesslevel
     * @return String
     **/
    public function getRequisitionerDesignation()
    {
        if (!(array) $this->requisitioner)
            return "";

        return $this->requisitioner['designation_name'] . ', ' . $this->requisitioner['accesslevel_name'];
    }

    // =============== RECOMMENDING APPROVAL METHODS ===============


    /** 
     * Returns recommending approval id
     * @return Int
     **/
    public function getRecommendingApprovalId()
    { return (Int) $this->recommendingApproval['user_id']; }


    /** 
     * Returns recommending approval accesslevel id
     * @return Int
     **/
    public function getRecommendingApprovalAccessLevelId()
    { return (Int) $this->recommendingApproval['accesslevel_id']; }


    /**
     * Returns reccomending approval name eg: LN, FN MN
     * @return String
     **/
    public function getRecommendingApprovalName()
    {
        if (!(array) $this->recommendingApproval)
            return '';

        return $this->recommendingApproval['lastname'] . ', ' . $this->recommendingApproval['firstname'] . ' ' . $this->recommendingApproval['middleinitial'];
    }


    /**
     * Returns recommending designation eg: designation, Accesslevel
     * @return String
     **/
    public function getRecommendingApprovalDesignation() : String
    {
        if (!(array) $this->recommendingApproval)
            return '';

        return $this->recommendingApproval['designation_name'] . ', ' . $this->recommendingApproval['accesslevel_name'];
    }

    
    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\Contracts\View\View|\Closure|string
     **/
    public function render()
    {
        return view('components.pr-form');
    }
}
