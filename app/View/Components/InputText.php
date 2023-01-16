<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputText extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $label;
    public $placeholder,$required,$error,$value,$disable,$type;
    public function __construct($name,$label,$placeholder='',$required=true,$error=false,$value=false,$disable=false,$type='text')
    {
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $data_type = [
            'text' => 'text',
            'email' => 'email',
            'password' => 'password',
            'number' => 'number'
        ];
        $this->type = $data_type[$type];
        if($placeholder=='') {
            $this->placeholder = 'Masukan '.$name;
        } else {
            $this->placeholder = $placeholder;
        }
        if ($error) {
            $this->error=$error;
        }
        if ($value) {
            $this->value = $value;
        }
        if ($disable) {
            $this->disable = $disable;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-text');
    }
}
