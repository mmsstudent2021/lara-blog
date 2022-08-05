<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $text,$color;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text,$color)
    {
        $this->text = $text;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
