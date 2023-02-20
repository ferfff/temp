<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class modalAgregarEditar extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $title,
        public $size = ""
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.modal-agregar-editar');
    }
}
