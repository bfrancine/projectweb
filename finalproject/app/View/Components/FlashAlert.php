<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FlashAlert extends Component
{
    public $type;
    public $message;

    public function __construct($type = 'success', $message = '')
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.flash-alert');
    }

    public function getStyles()
    {
        return match ($this->type) {
            'success' => 'bg-green-100 border-green-500 text-green-700',
            'error' => 'bg-red-100 border-red-500 text-red-700',
            'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
            'info' => 'bg-blue-100 border-blue-500 text-blue-700',
            default => 'bg-green-100 border-green-500 text-green-700',
        };
    }
}