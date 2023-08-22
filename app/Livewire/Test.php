<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class Test extends Component
{
    protected Service $service;
    public function mount($slug)
    {
        $this->service = Service::where('slug', $slug)->first();
    }
    public function render()
    {
        return view('livewire.test')->layoutData(['currentService' => $this->service]);
    }
}
