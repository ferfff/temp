<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Box extends Component
{

    public $title, $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $size,
        public $color,
        public $value,
        $title,
        $route
    ) {
        $this->title = ucwords($title);
        $this->route = route("$route.index");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.box');
    }
}
