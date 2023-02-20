<?php

namespace App\View\Components\Tables;

use Illuminate\View\Component;

class tr extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $item = null,
        public $expandable = false,
        public $columns = 5,
        public $detalle = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.tr');
    }
}
