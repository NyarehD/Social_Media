<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Post extends Component
{
    public $name, $created_time, $post_img_src;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $postImgSrc, $time = "This don't work"){
        $this->name = $name;
        $this->post_img_src = $postImgSrc;
        $this->created_time = $time;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render(){
        return view('components.post');
    }
}
