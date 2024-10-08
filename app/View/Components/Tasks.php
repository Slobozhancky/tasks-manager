<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tasks extends Component
{

    public $tasks;
    public $categories;
    public $statuses;
    /**
     * Create a new component instance.
     */
    public function __construct($tasks, $categories, $statuses)
    {
        $this->tasks = $tasks;
        $this->categories = $categories;
        $this->statuses = $statuses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks');
    }
}
