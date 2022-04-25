<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MessageModal extends Component
{

    private String $id;
    private String $title;
    private String $message;


    /**
     * Create a new component instance.
     * @param String id component id
     * @param String title component title
     * @param String message component message
     * @return void
     **/
    public function __construct(
        String $id, 
        String $title   = "Alert", 
        String $message = "Default alert message" 
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
    }


    /**
     * Returns component id
     * @return String
     **/ 
    public function getID()
    { return $this->id; }

    /**
     * Returns component title
     * @return String 
     **/
    public function getTitle()
    { return $this->title; }

    /**
     * Return component message
     * @return String 
     **/ 
    public function getMessage()
    { return $this->message; }


    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\Contracts\View\View|\Closure|string
     **/
    public function render()
    {
        return view('components.message-modal');
    }
}
