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
    public $category;
    /**
     * Create a new component instance.
     */
    public function __construct($tasks, $categories, $statuses, $category = null)
    {
        $this->tasks = $tasks;
        $this->categories = $categories;
        $this->statuses = $statuses;
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks');
    }
}
