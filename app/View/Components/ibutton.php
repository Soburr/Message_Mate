<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ibutton extends Component
{

    public $icon;
    public function __construct($icon =  null)
    {
        $this->icon = $icon;
    }


    public function render(): View|Closure|string
    {
        return view('components.ibutton');
    }
}
