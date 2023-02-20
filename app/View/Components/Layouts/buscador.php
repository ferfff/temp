<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class buscador extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $route,
        public $buscar,
        public $activo = null,
        public $show = false,
        public $todos = 'Todos',
        public $activos = 'Activos',
        public $inactivos = 'Inactivos',
        public $fieldset = false,
        public $range = false,
        public $datarange = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.buscador');
    }
}
