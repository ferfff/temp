<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class vacio extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $title = '¡Aviso!',
        public $text = 'No hay registros, agrega informacion o aplica otros filtos',
        public $type = 'warning'
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.vacio');
    }
}
