<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class chart extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $value,
        public $sizeColumn = '12',
        public $color = 'primary'
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.chart');
    }
}
