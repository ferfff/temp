<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Progress extends Component
{

    public $valueMin, $valueMax, $total, $mensaje;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($valueMin, $valueMax, $mensaje = 'Completo')
    {
        $this->valueMin = round($valueMin, 2);
        $this->valueMax = round($valueMax, 2);
        $this->total = round(($valueMin / $valueMax) * 100, 2);
        $this->mensaje = ucfirst($mensaje);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.progress');
    }
}
