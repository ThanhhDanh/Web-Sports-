<?php

namespace App\Livewire;

use App\Models\Events as ModelsEvents;
use Livewire\Component;

class Events extends Component
{

    public $status = 'all';
    public $search = '';

    public function  mount()
    {
        $this->updateStatus($this->status);
    }

    public function updateStatus($type)
    {
        $this->status = $type;
    }

    public function render()
    {
        $query = ModelsEvents::query();

        if ($this->status !== 'all') {
            $query->where('is_public', (int) $this->status);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }


        $events = $query->get()->toArray();
        return view('livewire.events', [
            'events' => $events,
        ]);
    }
}
