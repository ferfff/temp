<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class modalEliminarRestaurar extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $route,
        public $value,
        public $method,
        public $message,
        public $type,
        public $bgColor = "danger"
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.modal-eliminar-restaurar');
    }
}
