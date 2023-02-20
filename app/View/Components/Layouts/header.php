<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class header extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $title,
        public $message,
        public $route,
        public $icon,
        public $modalName = "",
        public $type = "redirect",
        public $excel = false,
        public $agregar = true
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.header');
    }
}
