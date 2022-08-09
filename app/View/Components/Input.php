<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;
    public $label;
    /**
     * @var false
     */
    public $multiple;
    /**
     * @var null
     */
    public $default;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name="input_name",$type="text",$label="Input Label",$multiple=false,$default=null)
    {
        //
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->multiple = $multiple;
        $this->default = $default;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
