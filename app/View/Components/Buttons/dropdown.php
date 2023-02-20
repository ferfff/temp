<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class dropdown extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $value,
        public $route,
        public $editar = true,
        public $text = 'Editar'
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.dropdown');
    }
}
