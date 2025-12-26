<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuestionCount extends Component
{


 public array $questionCount;
    /**
     * Create a new component instance.
     */
    public function __construct(?array $questionCount = null)
    {
        $this->questionCount = $questionCount ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.qustionCount', [
            'qustionCount' => $this->questionCount,
        ]);
    }
}
