<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class dropdownEliminar extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $value,
        public $route,
        public $permiso = "",
        public $viewId = true,
        public $methodShow = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.dropdown-eliminar');
    }
}
