<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toast extends Component
{
    public $toast_message;

    /**
     * @param $toast_message
     */
    public function __construct($toast_message){
        $this->toast_message = $toast_message;
    }

    public function render(){
        return view('components.toast');
    }

}
