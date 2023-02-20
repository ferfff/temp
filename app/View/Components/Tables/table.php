<?php

namespace App\View\Components\Tables;

use Illuminate\View\Component;

class table extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $headers,
        public $id = "table",
        public $class = "table-striped table-hover"
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.table');
    }
}
