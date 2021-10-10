<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    
    /**
     * The select label.
     *
     * @var string
     */
    public $label;
    /**
     * The select id.
     *
     * @var string
     */
    public $id;
    /**
     * The select name.
     *
     * @var string
     */
    public $name;
    /**
     * The select jsondata.
     *
     * @var string
     */
    public $jsondata;
    /**
     * The select option value.
     *
     * @var string
     */
    public $optionval;

    /**
     * The select option text.
     *
     * @var string
     */
    public $optiontext;



    
    public function __construct($label,$id,$name,$jsondata,$optionval,$optiontext)
    {
        $this->label = $label;
        $this->id = $id;
        $this->name = $name;
        $this->jsondata = $jsondata;
        $this->optionval = $optionval;
        $this->optiontext = $optiontext;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
