<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelect extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name, $label, $options, $required, $selected;
    public function __construct($name, $label, $options, $required = true, $selected = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->required = $required;
        if ($selected) {
            $this->selected = $selected;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-select');
    }
}
