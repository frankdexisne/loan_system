<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    protected string $id;

    protected string $module;

    protected string $pshowtools;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $module, $showtools)
    {
        $this->id = $id;
        $this->module = $module;
        $this->pshowtools = $showtools;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-table');
    }
}
