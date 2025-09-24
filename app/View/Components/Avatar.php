<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{
    public string $name;
    public int $size;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, int $size = 40)
    {
        $this->name = $name;
        $this->size = $size;
    }

    /**
     * Generate initials from the name.
     */
    public function initials(): string
    {
        $words = preg_split('/\s+/', trim($this->name));
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(mb_substr($word, 0, 1));
        }

        return $initials ?: '?';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.avatar');
    }
}
