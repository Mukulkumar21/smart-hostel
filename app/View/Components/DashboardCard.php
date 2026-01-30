<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardCard extends Component
{
    public string $title;
    public string|int $value;
    public string $color;

    public function __construct($title, $value, $color = 'blue')
    {
        $this->title = $title;
        $this->value = $value;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.dashboard-card');
    }
}