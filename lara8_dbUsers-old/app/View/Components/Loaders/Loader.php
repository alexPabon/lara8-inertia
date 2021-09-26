<?php

namespace App\View\Components\Loaders;

use Illuminate\View\Component;

class Loader extends Component
{
    public $size;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($size="20px")
    {
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.loaders.circle');
    }
}
