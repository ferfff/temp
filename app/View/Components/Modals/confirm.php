<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class confirm extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $text,
        public $idButton = 'button',
        public $idModal = 'confirm'
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.confirm');
    }
}
