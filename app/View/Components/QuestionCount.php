<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Questions;

class QuestionCount extends Component
{



 public array $savedquestion;
 public array $questionCount;
 public array $remarkedQuestion;
    /**
     * Create a new component instance.
     */
    public function __construct( ?array $savedquestion = null, ?array $questionCount = null, ?array $remarkedQuestion = null)
    {
        $this->savedquestion = $savedquestion ?? [];
        $this->questionCount = $questionCount ?? [];
        $this->remarkedQuestion = $remarkedQuestion ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.qustionCount', [
            'savedquestion' => $this->savedquestion,
            'questionCount' => $this->questionCount,
            'remarkedQuestion' => $this->remarkedQuestion,
        ]);
    }
}
