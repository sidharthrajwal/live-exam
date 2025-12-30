<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuestionCount extends Component
{


 public array $questioncount;
 public array $savedquestion;
    /**
     * Create a new component instance.
     */
    public function __construct(?array $questioncount = null, ?array $savedquestion = null)
    {
        $this->questioncount = $questioncount ?? [];
        $this->savedquestion = $savedquestion ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.qustionCount', [
            'questioncount' => $this->questioncount,
            'savedquestion' => $this->savedquestion,
        ]);
    }
}
